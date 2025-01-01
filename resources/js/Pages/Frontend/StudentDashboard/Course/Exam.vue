<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { ref, computed, onMounted } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);
const props = defineProps({
    settings: Object,
    AtendExam: Object,
    auth: Object,
    errors: Array,
});

// Initialize the form
const examAns = useForm({
    student_id: user.value.id,
    exam_id: props.AtendExam.id,
    answers: [],
    score: 0,
    is_passed: 0,
});

// Capture selected answers
const onOptionSelected = (questionId, optionId) => {
    const existingAnswer = examAns.answers.find((ans) => ans.question_id === questionId);
    if (existingAnswer) {
        existingAnswer.option_id = optionId;
    } else {
        examAns.answers.push({ question_id: questionId, option_id: optionId });
    }
};

// Submit answers
const onAnsSubmit = () => {
    if (examAns.answers.length === 0) {
        alert("Please attempt at least one question before submitting.");
        return;
    }
    examAns.post('/dashboard/student-exam-attempt', {
        onSuccess: () => {
            alert("Exam submitted successfully!");
        },
        onError: (errors) => {
            console.error("Submission failed:", errors);
        },
    });
};
</script>


<template>
    <StudentLayout :settings="settings">
        <div class="dashboard-content">
            <div class="w-full max-w-4xl mx-auto bg-white shadow-lg p-4">
                <div class="flex flex-col gap-5">
                    <div
                        v-for="(question, index) in AtendExam?.questions"
                        :key="question?.id"
                        class="border border-gray-300 p-3 rounded"
                    >
                        <h3>
                            {{ index + 1 }}. {{ question?.question_text }}
                        </h3>

                        <ul class="flex flex-wrap max-w-xl">
                            <li
                                class="w-1/2 p-2"
                                v-for="(option, i) in question.options"
                                :key="option?.id"
                            >
                                <input
                                    type="radio"
                                    :id="`option-${index}-${i}`"
                                    :name="`question-${question.id}`"
                                    class="hidden"
                                    :value="option?.id"
                                    @change="onOptionSelected(question.id, option.id)"
                                />
                                <label
                                    :for="`option-${index}-${i}`"
                                    class="flex items-center gap-3 cursor-pointer p-2 border border-transparent rounded-md hover:border-gray-300"
                                >
                                    <span
                                        class="size-5 rounded-full border border-secondary flex items-center justify-between"
                                    >
                                        <Icon
                                            name="material-symbols:check"
                                            class="text-white text-xl"
                                        />
                                    </span>
                                    <p>{{ option.option_text }}</p>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-5">
                    <div class="w-1/3">
                        <button
                            class="w-full bg-secondary py-2.5 rounded-md text-white"
                            @click.prevent="onAnsSubmit"
                        >
                            Submit
                        </button>
                    </div>
                    <div></div>
                    <div>
                        <div>Ideal Time: 1: 00 : 00</div>
                    </div>
                </div>
            </div>
        </div>
    </StudentLayout>
</template>

<<<<<<< HEAD
<style scoped>
input[type="radio"]:checked + label {
    background-color: #02006118;
    span {
        background-color: #020061;
    }
}
</style>
=======

<style scoped>
	input[type="radio"]:checked + label {
		background-color: #02006118;
		span {
			background-color: #020061;
		}
	}
</style>
>>>>>>> 82e5bc8a1f57b367ea2d178ad5f99b16b8aaf974
