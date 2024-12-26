<script setup>
import { ref } from "vue";
const isCmsLinks = ref(false);
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);
const props = defineProps({
    text: {
        type: Boolean,
        default: true,
    },
    settings: Object,
    auth: Object,
});

const logout = async () => {
    await Inertia.post("/Student/logout"); // Ensure to handle logout on server-side
};
</script>

<template>
    <div
        class="top-0 left-0 w-60 fixed h-screen border-r shadow-lg pt-24 bg-primary"
    >
        <ul
            class="flex flex-col text-white text-base font-bold tracking-wide leading-loose px-5"
        >
            <!-- Dashboard  -->
            <li>
                <Link
                    :href="`/students/${user.id}`"
                    class="group flex items-center gap-3 cursor-pointer relative p-2 active hover:bg-secondary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="bxs:dashboard"
                        class="text-2xl transition-all ease-in-out duration-500"
                    />
                    <span
                        class="transition-all ease-in-out duration-500"
                        >Dashboard</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/students/courses"
                    class="group flex items-center gap-3 cursor-pointer relative p-2 hover:bg-secondary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="ph:student-fill"
                        class="text-2xl transition-all ease-in-out duration-500"
                    />
                    <span
                        class="transition-all ease-in-out duration-500"
                        >Student</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/students/settings"
                    class="group flex items-center gap-3 cursor-pointer relative p-2 hover:bg-secondary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="material-symbols:book-5"
                        class="text-2xl transition-all ease-in-out duration-500"
                    />
                    <span
                        class="transition-all ease-in-out duration-500"
                        >Courses</span
                    >
                </Link>
            </li>

            <li>
                <Link
                    href="/dashboard/setting"
                    class="group flex items-center gap-3 cursor-pointer relative p-2 hover:bg-secondary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="hugeicons:settings-02"
                        class="text-2xl transition-all ease-in-out duration-500"
                    />
                    <span
                        class="transition-all ease-in-out duration-500"
                        >Settings</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/"
                    class="group flex items-center gap-3 cursor-pointer relative p-2 hover:bg-secondary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                    @click="logout"
                >
                    <Icon
                        name="lucide:log-out"
                        class="text-2xl transition-all ease-in-out duration-500"
                    />
                    <span
                        class="transition-all ease-in-out duration-500"
                        >Log Out</span
                    >
                </Link>
            </li>
        </ul>
    </div>
</template>
