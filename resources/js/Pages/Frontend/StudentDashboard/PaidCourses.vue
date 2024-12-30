<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

// Get user data and other props
const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);

const props = defineProps({
    settings: Object,
    auth: Object,
    courses: Array,  // Changed from 'Courses' to 'courses' for consistency
});

</script>

<template>
    <div class="dashboard-content">
        <div class="relative overflow-x-auto sm:rounded-lg p-5">
            <!-- If no courses available, show a message -->


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Loop through the courses -->
                <div
                    v-for="course in courses"
                    :key="course.id"
                    class="rounded-md shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800 border"
                >
                    <!-- Course Image -->
                    <img
                        :src="course.cover_image ? `/storage/img/${course.cover_image}` : '/images/default.png'"
                        alt="Course Image"
                        class="w-full h-48 object-cover rounded-t-lg"
                    />

                    <!-- Card Content -->
                    <div class="p-4">
                        <!-- Course Title -->
                        <h3 class="text-lg font-bold text-black dark:text-white">{{ course.title }}</h3>

                        <!-- Price -->
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                            <span class="font-medium">Price: </span>
                            <span class="text-base font-extrabold">৳</span>
                            <span class="text-black">{{ course.price }}</span>
                        </p>

                        <!-- Category -->
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">
                            <span class="font-medium">Category:</span> {{ course.category?.name }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex justify-end items-center mt-4 gap-2">
                            <!-- View Button -->
                            <Link
                                :href="`/dashboard/course/${course.id}`"
                                class="text-white font-semibold hover:bg-secondary bg-emerald-600 px-2 py-1 rounded-sm"
                            >
                                <Icon name="material-symbols-light:eye-tracking-sharp" class="text-lg" />
                            </Link>

                            <!-- Edit Button -->
                            <Link
                                :href="`/dashboard/course/${course.id}/edit`"
                                class="text-white font-semibold hover:bg-secondary bg-primary px-2 py-1 rounded-sm"
                            >
                                <Icon name="material-symbols:edit-square-outline" class="text-lg" />
                            </Link>

                            <!-- Delete Button -->
                            <button
                                @click.prevent="deleteCourse(course.id)"
                                class="text-white font-semibold hover:bg-secondary bg-rose-500 px-2 py-1 rounded-sm"
                            >
                                <Icon name="material-symbols:delete-outline" class="text-lg" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
