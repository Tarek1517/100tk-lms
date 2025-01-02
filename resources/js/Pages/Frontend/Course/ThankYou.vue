<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";

const props = defineProps({
    home_categories: Array,
    course_categories: Array,
    settings: Object,
    errors: Array,
});
</script>

<template>
    <AppLayout :settings="settings">
        <section>
            <!-- Courses Grid Section -->
            <Container>
                <div
                    class="flex flex-col items-center justify-center text-center py-12"
                >
                    <img
                        class="w-1/6 h-auto object-cover rounded-xl"
                        src="@/assets/images/education-logo.png"
                        alt="Education Logo"
                    />
                    <p
                        class="text-4xl text-white bg-primary font-bold mt-6 px-10 py-2 rounded-md"
                    >
                        Thank You,
                    </p>
                    <p class="text-6xl font-bold mt-2">
                        For Purchasing this Course !!
                    </p>
                    <a
                        href="/"
                        class="bg-secondary text-white font-semibold py-2 lg:py-3 px-10 rounded-full my-8 hover:bg-primary transition-all ease-in-out duration-500 flex items-center justify-center gap-1"
                    >
                        Back to Home Page
                        
                    </a>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>
