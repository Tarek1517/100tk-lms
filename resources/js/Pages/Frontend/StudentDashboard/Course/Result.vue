<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "vue3-toastify";

const props = defineProps({
    Results: Array,
});
</script>

<template>
    <StudentLayout :settings="settings">
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            class="text-lg"
                        />
                        <h3 class="text-lg font-medium">Exam Results</h3>
                    </div>
                </div>
            </div>
            <div
                class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 p-4"
            >
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-3 py-3">Exam Title</th>
                            <th scope="col" class="px-3 py-3">Your Score</th>
                            <th scope="col" class="px-3 py-3">Pass or Fail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 hover:shadow-lg transition-all ease-in-out duration-300 dark:hover:bg-gray-600"
                            v-for="Result in Results"
                            :key="Result.id"
                        >
                            <td class="py-1">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ Result?.exam?.title }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ Result.score }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-1">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        <span v-if="Result.is_passed === 1"
                                            >Pass</span
                                        >
                                        <span v-else>Fail</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </StudentLayout>
</template>
