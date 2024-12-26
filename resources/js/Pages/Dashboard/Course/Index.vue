<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "vue3-toastify";

const props = defineProps({
    AllCourses: Array,
});

// Deleting a category
const deleteCourse = async (courseId) => {
    try {
        await Inertia.delete(`/dashboard/course/${courseId}`);

        toast.success("Course Deleted Successfully", { autoClose: 3000 });
    } catch (error) {
        toast.error("Failed to delete Course", { autoClose: 3000 });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            class="text-lg"
                        />
                        <h3 class="text-lg font-medium">All Courses</h3>
                    </div>
                    <div>
                        <Link
                            href="/dashboard/course/create"
                            class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal"
                        >
                            <Icon name="material-symbols:add-box-outline" />
                            Add Record
                        </Link>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-base-color">
                    <Search />
                </div>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg p-5">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5"
                >
                    <div
                        v-for="Courses in AllCourses"
                        :key="Courses.id"
                        class="rounded-md shadow-md hover:shadow-lg transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800 border"
                    >
                        <!-- Course Image -->
                        <img
                            :src="
                                Courses.cover_image
                                    ? `/storage/img/${Courses.cover_image}`
                                    : '/images/default.png'
                            "
                            alt="Course Image"
                            class="w-full h-48 object-cover rounded-t-lg"
                        />

                        <!-- Card Content -->
                        <div class="p-4">
                            <!-- Course Title -->
                            <h3
                                class="text-lg font-bold text-black dark:text-white"
                            >
                                {{ Courses.title }}
                            </h3>

                            <!-- Price -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Price: </span>
                                <span class="text-base font-extrabold">৳</span
                                ><span class="text-black">{{
                                    Courses.price
                                }}</span>
                            </p>

                            <!-- Category -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Category:</span>
                                {{ Courses.category?.name }}
                            </p>

                            <!-- Action Buttons -->
                            <div
                                class="flex justify-end items-center mt-4 gap-2"
                            >
                                <!-- Edit Button -->

                                <Link
                                    :href="`/dashboard/course/${Courses.id}`"
                                    class="text-white font-semibold hover:bg-secondary bg-emerald-600 px-2 py-1 rounded-sm"
                                >
                                    <Icon
                                        name="material-symbols-light:eye-tracking-sharp"
                                        class="text-lg"
                                    />
                                </Link>

                                <Link
                                    :href="`/dashboard/course/${Courses.id}/edit`"
                                    class="text-white font-semibold hover:bg-secondary bg-primary px-2 py-1 rounded-sm"
                                >
                                    <Icon
                                        name="material-symbols:edit-square-outline"
                                        class="text-lg"
                                    />
                                </Link>

                                <!-- Delete Button -->
                                <button
                                    @click.prevent="deleteCourse(Courses.id)"
                                    class="text-white font-semibold hover:bg-secondary bg-rose-500 px-2 py-1 rounded-sm"
                                >
                                    <Icon
                                        name="material-symbols:delete-outline"
                                        class="text-lg"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
