<script setup>
// import { ref } from 'vue';

import SideBar from "@/Components/Header/SideBar.vue";
import TopBar from "@/Components/Header/TopBar.vue";

// const showingNavigationDropdown = ref(false);
</script>

<template>
    <SideBar />
    <TopBar />
    <main class="ml-60 p-4 mt-10">
        <slot />
    </main>
</template>
