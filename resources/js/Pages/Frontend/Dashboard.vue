<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import Dash from "@/Pages/Frontend/StudentDashboard/Dash.vue";

const props = defineProps({
    settings: Object,
});
</script>

<template>
    <StudentLayout :settings="settings">
        <div class="dashboard-content">
            <Dash />
        </div>
    </StudentLayout>
</template>
