<script setup>
import HeroSection from "@/Components/Home/HeroSection.vue";
import CategorySection from "@/Components/Home/CategorySection.vue";
import Section from "@/Components/Home/Section.vue";

const props = defineProps({
    home_categories: Array,
    course_categories: Array,
    settings: Object,
    auth: Object,
});
</script>

<template>
    <AppLayout :settings="settings" :auth="auth">
        <HeroSection />
        <CategorySection :home_categories="home_categories" />
        <div class="mt-5 mb-10">
            <Section
                v-for="category in course_categories"
                :key="category.id"
                :title="category.name"
                :courses="category.course"
            />
        </div>
    </AppLayout>
</template>

<style scoped></style>
