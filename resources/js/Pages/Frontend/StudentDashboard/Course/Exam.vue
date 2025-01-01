<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);

const props = defineProps({
    settings: Object,
    AtendExam: Object,
    auth: Object,
    errors: Array,
});
</script>

<template>
    <StudentLayout :settings="settings">
        <div class="dashboard-content">
            <div class="w-full max-w-4xl mx-auto bg-white shadow-lg p-4">
                <div class="flex flex-col gap-5">
                    <div
                        v-for="Question in AtendExam.questions"
                        :key="Question.id"
                        class="border border-gary-300 p-3 rounded"
                    >
                        <h3>
                            {{ Question.question_text }}
                        </h3>

                        <ul class="flex flex-wrap max-w-xl">
                            <li
                                class="w-1/2 p-2"
                                v-for="(option, index) in Question.options"
                                :key="index"
                            >
                                <input
                                    type="radio"
                                    :id="`option-${index}`"
                                    name="option"
                                    class="hidden"
                                />
                                <label
                                    :for="`option-${index}`"
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

                <div class="mt-4 flex items-center">
                    <div class="w-1/3">
                        <button
                            class="w-full bg-secondary py-2.5 rounded-md text-white"
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

<style scoped>
input[type="radio"]:checked + label {
    background-color: #02006118;
    span {
        background-color: #020061;
    }
}
</style>
