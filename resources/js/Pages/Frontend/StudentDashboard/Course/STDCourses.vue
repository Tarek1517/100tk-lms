<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);

const props = defineProps({
    settings: Object,
    PaidCourses: Array,
    auth: Object,
});
</script>

<template>
    <StudentLayout :settings="settings">
        <div class="dashboard-content">
            <h2 class="text-2xl font-bold p-5 border-b-4 border-primary mb-5">
                যে কোর্সসমূহ, আপনি <span class="text-primary">ক্রয়</span> করেছেন!
            </h2>

            <div class="relative overflow-x-auto sm:rounded-lg p-5">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10"
                >
                    <!-- Loop through PaidCourses -->
                    <div
                        v-for="course in PaidCourses"
                        :key="course.id"
                        class="rounded-md shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800 border"
                    >
                        <!-- Course Image -->
                        <Link :href="`/Coures/${course.slug}/show`">
                            <img
                                :src="
                                    course.cover_image
                                        ? `/storage/img/${course.cover_image}`
                                        : '/images/default.png'
                                "
                                alt="Course Image"
                                class="w-full h-56 object-cover rounded-t-lg"
                            />
                        </Link>

                        <!-- Card Content -->
                        <div class="p-4">
                            <!-- Course Title -->
                            <h3
                                class="text-lg font-bold text-black dark:text-white"
                            >
                                {{ course.title }}
                            </h3>

                            <!-- Price -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Price: </span>
                                <span class="text-base font-extrabold">৳</span>
                                <span class="text-black">{{
                                    course.price
                                }}</span>
                            </p>

                            <!-- Action Buttons -->
                            <div
                                class="flex justify-between items-center mt-4 gap-2"
                            >
                                <span
                                    class="flex items-center font-medium text-xs lg:text-sm text-nowrap gap-2"
                                >
                                    <Icon
                                        name="solar:notebook-minimalistic-broken"
                                        class="text-xl text-primary"
                                    />
                                    {{
                                        course.course_class
                                            ? course.course_class.length
                                            : 0
                                    }}
                                    Classes
                                </span>
                                <!-- View Button -->
                                <Link
                                    :href="`/coures/${course.slug}/show`"
                                    class="text-white font-semibold hover:bg-secondary bg-emerald-600 px-2 py-1 rounded-sm"
                                >
                                    <Icon
                                        name="material-symbols-light:eye-tracking-sharp"
                                        class="text-lg"
                                    />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </StudentLayout>
</template>
