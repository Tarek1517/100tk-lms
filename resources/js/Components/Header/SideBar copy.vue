<script setup>
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);

const props = defineProps({
    settings: Object,
    auth: Object,
});
const logout = async () => {
    await Inertia.post("/Student/logout"); // Ensure to handle logout on server-side
};
</script>

<template>
    <ul class="table w-full border border-primary border-collapse ">
        <li class="table-row">
            <a
                :href="`/students/${user.id}`"
                class="table-cell p-3 border border-primary text-center hover:bg-primary hover:text-white"
            >
                Dashboard
            </a>
        </li>
        <li class="table-row">
            <a
                href="/students/courses"
                class="table-cell p-3 border border-primary text-center hover:bg-primary hover:text-white"
            >
                Courses
            </a>
        </li>
        <li class="table-row">
            <a
                href="/students/settings"
                class="table-cell p-3 border border-primary text-center hover:bg-primary hover:text-white"
            >
                Settings
            </a>
        </li>
        <li class="table-row">
            <a
                @click="logout"
                class="table-cell p-3 border border-primary text-center cursor-pointer hover:bg-primary hover:text-white"
            >
                Logout
            </a>
        </li>
    </ul>
</template>
