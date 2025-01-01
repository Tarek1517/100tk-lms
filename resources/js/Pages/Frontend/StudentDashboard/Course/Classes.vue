<script setup>
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props?.auth?.validStudent);

const props = defineProps({
    settings: Object,
    course: Object,
    auth: Object,
});

const selectedVideoUrl = ref("");
const currentVideoIndex = ref(0);

const openVideo = (url) => {
    if (!url || typeof url !== "string") {
        console.error("Invalid video URL:", url);
        selectedVideoUrl.value = "";
        return;
    }
    selectedVideoUrl.value = url;
};

const getVimeoEmbedUrl = (url) => {
    if (!url) return "";
    const match = url.match(/vimeo\.com\/(\d+)/);
    return match ? `https://player.vimeo.com/video/${match[1]}` : "";
};

onMounted(() => {
    if (props.course?.course_class?.length > 0) {
        selectedVideoUrl.value =
            props.course.course_class[0]?.video_url?.video_url;
    }
});

const changeVideo = (direction) => {
    if (props.course?.course_class?.length > 0) {
        if (direction === "previous" && currentVideoIndex.value > 0) {
            currentVideoIndex.value -= 1;
        } else if (
            direction === "next" &&
            currentVideoIndex.value < props.course.course_class.length - 1
        ) {
            currentVideoIndex.value += 1;
        }
        selectedVideoUrl.value =
            props.course.course_class[
                currentVideoIndex.value
            ]?.video_url?.video_url;
    }
};
</script>

<template>
    <StudentLayout :settings="settings">
        <div class="dashboard-content">
            <div class="flex items-center gap-4 p-5">
                <!-- Course Cover Image -->
                <img
                    :src="
                        course.cover_image
                            ? `/storage/img/${course.cover_image}`
                            : '/images/default.png'
                    "
                    alt="Course Image"
                    class="w-30 h-20 object-cover rounded-lg"
                />

                <div class="flex flex-col">
                    <!-- Course Title -->
                    <h2 class="text-xl font-bold mb-2">
                        <span class="text-primary">{{ course.title }}</span>
                        Classes !
                    </h2>

                    <!-- Course Class Count -->
                    <span
                        class="flex items-center gap-1 font-medium text-xs lg:text-sm text-nowrap"
                    >
                        <Icon
                            name="solar:notebook-minimalistic-broken"
                            class="text-sm"
                        />
                        {{
                            course.course_class ? course.course_class.length : 0
                        }}
                        Classes
                    </span>
                </div>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg p-5">
                <div class="flex flex-col lg:flex-row gap-5">
                    <!-- Video Player Section -->
                    <div class="w-full lg:w-2/3">
                        <div
                            class="shadow-md hover:shadow-lg dark:bg-gray-800 border"
                        >
                            <!-- If video URL is available, show the player -->
                            <iframe
                                v-if="selectedVideoUrl"
                                :src="getVimeoEmbedUrl(selectedVideoUrl)"
                                width="100%"
                                height="400"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                            <!-- Placeholder message if no video selected -->
                            <p
                                v-else
                                class="text-center text-sm text-gray-500 p-4"
                            >
                                No video selected. Click on a class to play the
                                video.
                            </p>
                        </div>
                        <div class="flex justify-between mt-10">
                            <!-- Previous Button -->
                            <button
                                :disabled="currentVideoIndex <= 0"
                                @click="changeVideo('previous')"
                                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                            >
                                Previous Video
                            </button>

                            <!-- Next Button -->
                            <button
                                :disabled="
                                    currentVideoIndex >=
                                    course.course_class.length - 1
                                "
                                @click="changeVideo('next')"
                                class="bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary disabled:bg-gray-300 disabled:text-gray-500 disabled:cursor-not-allowed"
                            >
                                Next Video
                            </button>
                        </div>
                    </div>

                    <!-- Right Side: Table -->
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg w-full lg:w-1/3"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ course.title }} Class Videos
                                    </th>
                                    <th scope="col" class="px-6 py-3">Exam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="classItem in course.course_class"
                                    :key="classItem.id"
                                    :class="{
                                        'bg-primary':
                                            selectedVideoUrl &&
                                            selectedVideoUrl ===
                                                classItem.video_url?.video_url,
                                    }"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 transition-all ease-in-out duration-300 dark:hover:bg-gray-600"
                                >
                                    <td>
                                        <button
                                            class="mt-2 dark:hover:text-gray-300 text-black px-2 py-1 flex items-center rounded-full gap-2 font-normal pl-5"
                                            @click="
                                                openVideo(
                                                    classItem.video_url
                                                        ?.video_url
                                                )
                                            "
                                        >
                                            <Icon
                                                name="ep:video-play"
                                                class="text-2xl bg-primary rounded-full p-1 text-white"
                                            />
                                            <span class="hover:text-primary">{{
                                                classItem.name
                                            }}</span>
                                        </button>
                                    </td>

                                    <td>
                                        <Link
                                            :href="`/Exam/attend_exam/${classItem.exam.id}`"
                                            class="text-sm bg-primary hover:bg-secondary px-2 py-1 rounded text-white"
                                        >
                                            Attend Exam
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </StudentLayout>
</template>
