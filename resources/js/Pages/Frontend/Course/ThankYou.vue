<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CourseCard2 from "@/Components/CourseCard2.vue";
import Container from "@/Components/Container.vue";


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

                <div class="text-center py-12">
                    <p>No courses available at the moment.</p>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>
