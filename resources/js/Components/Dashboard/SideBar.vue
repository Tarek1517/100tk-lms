<script setup>
import { ref } from "vue";
const props = defineProps({
    text: {
        type: Boolean,
        default: true,
    },
});

const isCmsLinks = ref(false);
</script>

<template>
    <div
        class="top-0 left-0 w-60 bg-white fixed h-screen border-r shadow-lg pt-24"
    >
        <ul
            class="flex flex-col text-gray-500 text-base font-bold tracking-wide leading-loose px-5"
        >
            <!-- Dashboard  -->
            <li>
                <Link
                    href="/dashboard"
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 active hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="bxs:dashboard"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                        >Dashboard</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/dashboard/student"
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="ph:student-fill"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                        >Student</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/dashboard/course"
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="material-symbols:book-5"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                        >Courses</span
                    >
                </Link>
            </li>
            <li>
                <Link
                    href="/dashboard/category"
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="tabler:category"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                        >Categories</span
                    >
                </Link>
            </li>

            <li>
                <div
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                    @click="isCmsLinks = !isCmsLinks"
                >
                    <Icon
                        name="material-symbols:add-home-work-rounded"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                    >
                        CMS
                    </span>
                    <div
                        class="absolute top-1/2 -translate-y-1/2 right-2 transition-all ease-in-out duration-300"
                        :class="{ 'rotate-90': isCmsLinks }"
                    >
                        <Icon
                            name="ic:twotone-keyboard-arrow-right"
                            size="20"
                            class="transition-all ease-in-out duration-300"
                        />
                    </div>
                </div>
                <div
                    class="overflow-hidden transition-all ease-in-out duration-500"
                    :style="{
                        maxHeight: isCmsLinks ? '500px' : '0px',
                        opacity: isCmsLinks ? 1 : 0,
                    }"
                >
                    <ul class="shop-links flex flex-col pl-4">
                        <li>
                            <Link
                                href="/dashboard/page"
                                class="group flex items-center gap-3 cursor-pointer relative pl-5 transition-all ease-in-out duration-500"
                            >
                                <Icon
                                    name="material-symbols:arrow-circle-right"
                                    class="text-lg group-hover:text-primary transition-all ease-in-out duration-500"
                                />
                                <span
                                    class="group-hover:text-primary transition-all ease-in-out duration-500 font-medium"
                                >
                                    Pages
                                </span>
                            </Link>
                        </li>

                        <!-- Add more links here -->
                    </ul>
                </div>
            </li>
            <li>
                <Link
                    href="/dashboard/setting"
                    class="group flex items-center gap-3 cursor-pointer relative p-2.5 hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500"
                >
                    <Icon
                        name="hugeicons:settings-02"
                        class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500"
                    />
                    <span
                        class="group-hover:text-primary transition-all ease-in-out duration-500"
                        >Settings</span
                    >
                </Link>
            </li>
        </ul>
    </div>
</template>
