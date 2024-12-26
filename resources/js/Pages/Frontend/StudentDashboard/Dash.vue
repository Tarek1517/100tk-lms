<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);
const props = defineProps({
    settings: Object,
    auth: Object,
});
</script>

<template>
    <div class="dashboard-content">
        <h2 class="text-xl font-bold">Welcome, <span class="text-primary">{{ user.name }}!</span></h2>
        <p>Here is your personalized dashboard.</p>
        <!-- Add more student-specific content -->
    </div>
</template>
