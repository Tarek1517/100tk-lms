<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    editQuestion: Object,
    errors: Array,
});

const questionState = useForm({
    exam_id: props.editQuestion[0]?.exam_id || null,
    questions: props.editQuestion.map((question) => ({
        id: question.id, // Use the id of the question
        question_text: question.question_text,
        options: question.options.map((option) => ({
            option_text: option.option_text,
            is_correct: option.is_correct,
        })),
    })),
});

const onUpdate = () => {
    
    questionState.questions.forEach((question) => {
        questionState.put(`/dashboard/exam-question/${question.id}`, {
            preserveScroll: true,
        });
    });
};
</script>
<template>
    <AuthenticatedLayout>
        <section class="pb-20">
            <div class="w-full pr-5">
                <div class="grid grid-cols-2 gap-5">
                   
                    <div
                        v-for="(question, index) in questionState.questions"
                        :key="index"
                        class="border border-primary/40 rounded-md p-3 pt-5 relative"
                    >
                        <InputLabel :value="`${index + 1}. Question Title`" />
                        <TextInput
                            class="w-full"
                            v-model="question.question_text"
                        />

                        <div class="flex flex-col gap-3 py-5">
                            <div
                                class="flex gap-3"
                                v-for="(option, i) in question.options"
                                :key="i"
                            >
                                <div>
                                    <InputLabel :value="`Option ${i + 1}`" />
                                    <TextInput
                                        class="w-full"
                                        v-model="option.option_text"
                                    />
                                </div>
                                <div>
                                    <InputLabel value="Is Correct" />
                                    <input
                                        :id="`answer-${index}-${i}`"
                                        type="radio"
                                        :name="`answer-${index}`"
                                        value="1"
                                        v-model="option.is_correct"
                                        class="peer hidden"
                                    />
                                    <label
                                        :for="`answer-${index}-${i}`"
                                        class="flex items-center justify-center size-5 rounded-full border border-secondary peer-checked:bg-secondary cursor-pointer"
                                    >
                                        <Icon
                                            name="material-symbols:check-rounded"
                                            class="text-white"
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button
                        @click="onUpdate"
                        class="bg-primary w-full py-3 rounded-md text-white"
                    >
                        Update Questions
                    </button>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
