<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    CreateQuestion: Object,
    errors: Array,
});

// Create Exam Question
const questionState = useForm({
    exam_id: props.CreateQuestion.id, // need to remove 1 and make it dynamic
    questions: [
        {
            question_text: null,
            questoin_image: null,
            options: [
                {
                    option_text: null,
                    is_correct: 0,
                },
                {
                    option_text: null,
                    is_correct: 0,
                },
                {
                    option_text: null,
                    is_correct: 0,
                },
                {
                    option_text: null,
                    is_correct: 0,
                },
            ],
        },
    ],
});

const addQuestionItem = () => {
    questionState.questions.push({
        question_text: null,
        questoin_image: null,
        options: [
            {
                option_text: null,
                is_correct: 0,
            },
            {
                option_text: null,
                is_correct: 0,
            },
            {
                option_text: null,
                is_correct: 0,
            },
            {
                option_text: null,
                is_correct: 0,
            },
        ],
    });
};

const removeQuestionItem = (index) => questionState.questions.splice(index, 1);

const onQuiestionSubmit = () => {
    questionState.post("/dashboard/exam-question");
};
</script>
<template>
    <AuthenticatedLayout>
        <section class="pb-20">
            {{ errors }}
            <div class="w-full pr-5">
                <div class="grid grid-cols-2 gap-5">

                    <div
                        v-for="(item, index) in questionState.questions"
                        :key="index"
                        class="border border-primary/40 rounded-md p-3 pt-5 relative"
                    >
                        <button
                            v-if="questionState?.questions?.length > 1"
                            @click="removeQuestionItem(index)"
                            class="absolute top-1 right-1 text-sm px-2 py-1 rounded-md"
                        >
                            <Icon
                                name="material-symbols:delete-outline"
                                class="text-lg text-rose-700"
                            />
                        </button>
                        <InputLabel :value="`${index + 1}. Question Title`" />
                        <TextInput
                            class="w-full"
                            v-model="item.question_text"
                        />
                        <div class="flex flex-col gap-3 py-5">
                            <div
                                class="flex gap-3"
                                v-for="(option, i) in item.options"
                                :key="`option-${i}`"
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
                <div class="mt-5">
                    <button
                        @click="addQuestionItem"
                        class="bg-secondary text-white px-4 py-2 rounded-md text-sm font-normal"
                    >
                        Add More Question
                    </button>
                </div>
                <div class="mt-10">
                    <button
                        @click="onQuiestionSubmit"
                        class="bg-primary w-full py-3 rounded-md text-white"
                    >
                        Save Questions
                    </button>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
