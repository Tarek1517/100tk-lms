<script setup>
import Icon from "@/Components/Icon.vue";
import { defineProps } from "vue";

const props = defineProps({
    course: Array,
});
</script>

<template>
    <div class="rounded-xl border">
        <div class="p-3 lg:p-4">
            <Link
                href="/courses/3"
                class="w-full h-[270px] rounded-xl overflow-hidden"
            >
                <img
                    class="w-full h-full object-cover rounded-xl"
                    :src="`/storage/img/${course.cover_image}`"
                    :alt="course.name"
                />
            </Link>
            <div class="pt-3 lg:pt-3">
                <Link href="/courses/3">
                    <h2
                        class="text-sm lg:text-xl font-medium hover:text-primary transition-all ease-in-out duration-500"
                    >
                        {{ course.title }}
                    </h2>
                </Link>
                <ul
                    class="flex flex-wrap gap-1 lg:-mx-2 pt-3 lg:pt-7 text-gray-400"
                >
                    <li
                        class="flex items-center gap-1 lg:px-4 font-medium text-xs lg:text-sm text-nowrap"
                    >
                        <Icon
                            name="solar:notebook-minimalistic-broken"
                            class="text-sm"
                        />
                        {{
                            course.course_class ? course.course_class.length : 0
                        }}
                        Classes
                    </li>
                    <li
                        class="flex items-center gap-1 lg:px-4 font-medium text-xs lg:text-sm text-nowrap"
                    >
                        <Icon name="ph:student-thin" class="text-sm" />
                        Students 50
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="flex flex-wrap gap-2 lg:gap-0 justify-between p-3 lg:p-5 border-t"
        >
            <p class="text-xl font-semibold text-primary">
                {{ course.price }}৳
            </p>
            <Link
                href="/courses/3"
                class="flex items-center gap-1 text-sm lg:text-base text-secondary font-semibold px-4 py-1 border rounded-full hover:border-primary transition-all ease-in-out duration-500"
            >
                View Details
                <Icon name="ri:send-plane-fill" class="text-sm" />
            </Link>
        </div>
    </div>
</template>
