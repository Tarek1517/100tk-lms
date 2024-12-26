<script setup>
import Header from '@/Components/Header.vue'
import Footer from '@/Components/Footer.vue'
import MobileHeader from "@/Components/Header/MobileHeader.vue";

const props = defineProps({
    settings: Object,

});
</script>
<template>
    <MobileHeader :settings="settings" />
    <Header :settings="settings" />
        <main>
            <slot name="student" v-if="isStudent" />
            <slot v-else />
        </main>
    <Footer />
</template>
