<script setup>

import TopHeader from "@/Components/Header/TopHeader.vue";
import NavHeader from "@/Components/Header/NavHeader.vue";
const props = defineProps({
    settings: Object,
});
</script>

<template>
    <div class="hidden lg:block">
        <TopHeader :settings="settings"/>
        <NavHeader :settings="settings"/>
    </div>
</template>

<style scoped>

</style>
