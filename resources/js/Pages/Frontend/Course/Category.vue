<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CourseCard2 from "@/Components/CourseCard2.vue";
import Container from "@/Components/Container.vue";

// Import the image directly
import bannerImage from "@/assets/images/banner.png";

const props = defineProps({
    AllCourses: {
        type: Array,
        required: true,
    },
    course_categories: {
        type: Array,
        default: () => [],
    },
    settings: {
        type: Object,
        required: true,
    },
    auth: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    <AppLayout :settings="settings" :auth="auth">
        <section>
            <!-- Banner Section -->
            <div class="w-full h-52 lg:h-96 relative">
                <img 
                    class="w-full h-full object-cover" 
                    :src="bannerImage" 
                    alt="Banner Image"
                />
                <h2 
                    class="absolute text-3xl lg:text-5xl font-semibold text-white text-center inset-x-0 top-1/2 transform -translate-y-1/2"
                >
                সব কোর্স
                </h2>
            </div>

            <!-- Courses Grid Section -->
            <Container>
                <div v-if="AllCourses.length > 0" class="grid grid-cols-2 lg:grid-cols-3 gap-5 my-12">
                    <CourseCard2 
                        v-for="course in AllCourses" 
                        :key="course.id" 
                        :course="course" 
                    />
                </div>
                <div v-else class="text-center py-12">
                    <p>No courses available at the moment.</p>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>
