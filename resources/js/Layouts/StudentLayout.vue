<script setup>
import StdDashboardLayout from "@/Layouts/StdDashboardLayout.vue";
import { Inertia } from "@inertiajs/inertia";
</script>

<template>
    <StdDashboardLayout :settings="settings" isStudent>
        <div
            class="student-layout flex justify-center items-start w-full h-full mb-10"
        >
            <!-- Wrapper for full width -->
            <div class="flex w-full h-full overflow-hidden">
                <!-- Main Content -->
                <div
                    class="w-full bg-white p-6"
                >
                    <slot />
                </div>
            </div>
        </div>
    </StdDashboardLayout>
</template>

<style scoped>
.student-layout {
    display: flex;
    height: 100%;
}
</style>
