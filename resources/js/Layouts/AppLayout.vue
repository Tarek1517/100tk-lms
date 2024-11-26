<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import MobileHeader from "@/Components/Header/MobileHeader.vue";
</script>
<template>
    <MobileHeader />
    <Header />
        <main>
            <slot />
        </main>
    <Footer />
</template>
