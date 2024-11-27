<script setup>
import HeroSection from "@/Components/Home/HeroSection.vue";
import CategorySection from "@/Components/Home/CategorySection.vue";
import Section from "@/Components/Home/Section.vue";
</script>

<template>
    <AppLayout>
        <HeroSection />
        <CategorySection />
        <Section title="BCS পরীক্ষার প্রস্তুতি" viewDetails="BCS Details" />
        <Section title="Bank Job পরীক্ষার প্রস্তুতি" viewDetails="Bank Job Details" />
    </AppLayout>

</template>

<style scoped>

</style>
