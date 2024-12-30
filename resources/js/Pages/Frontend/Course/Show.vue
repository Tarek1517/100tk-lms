<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CourseCard2 from "@/Components/CourseCard2.vue";
import Container from "@/Components/Container.vue";

// Import the image directly
import bannerImage from "@/assets/images/banner.png";

const props = defineProps({
    AllCourses: {
        type: Array,
        required: true,
        default: () => [], // Default to an empty array
    },
    course_categories: {
        type: Array,
        default: () => [],
    },
    settings: {
        type: Object,
        required: true,
    },
    auth: {
        type: Object,
        required: false,
    },
    showCourse: Object,
});

</script>

<template>
    <AppLayout :settings="settings" :auth="auth">
        <Container>
            <div
                class="flex flex-wrap py-12 lg:-mx-8 bg-[url('https://html.rrdevs.net/edcare/assets/img/shapes/hero-shape-3.png')] bg-no-repeat"
            >
                <div class="w-full lg:w-3/5 lg:px-8">
                    <div class="pt-8 lg:pt-0">
                        <h2 class="text-3xl lg:text-6xl font-bold">
                            {{ showCourse.title }}
                        </h2>
                        <p
                            class="text-sm text-gray-500 py-8 max-w-xl leading-relaxed"
                        >
                        {{ showCourse.short_description }}
                        </p>
                        <div>
                            <h3
                                class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8"
                            >
                                Study Plan
                            </h3>
                            <ul
                                class="flex flex-wrap gap-2 py-4 text-gray-500 border border-secondary rounded-lg my-9"
                            >
                                <li
                                    class="flex items-center gap-3 px-4"
                                    v-for="Classes in showCourse.course_class"
                                    :key="Classes.id"
                                >
                                    <Icon
                                        name="line-md:confirm-circle-to-circle-twotone-transition"
                                        class="text-primary"
                                    />
                                    {{ Classes.name }}
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3
                                class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8"
                            >
                                About Course
                            </h3>
                            <p
                                class="text-sm text-gray-500 py-8 max-w-xl leading-relaxed"
                            >
                            <div v-html="showCourse.description" class="quill-content"></div>
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="w-full lg:w-2/5 lg:px-8 order-first lg:order-none pt-6 lg:pt-0"
                >
                    <div class="border">
                        <div class="w-full h-80">
                            <img
                                class="w-full h-full object-cover"
                                :src="`/storage/img/${showCourse.cover_image}`"
                                :alt="showCourse.title"
                            />
                        </div>
                        <div class="p-4">
                            <h2 class="text-3xl font-bold text-primary">
                                Fee {{ settings.currency_symbol }} {{ showCourse.price }}
                            </h2>
                            <div class="border-b">
                                <Link
                                    :href="`/course/checkout/${showCourse.id}`"
                                    class="flex items-center justify-center text-white gap-2 bg-secondary hover:bg-primary w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500"
                                >
                                    Enroll Now This Course
                                    <Icon name="material-symbols:arrow-forward-ios-rounded" />
                                </Link>
                            </div>
                            <h4
                                class="text-base font-semibold pt-5 text-gray-500"
                            >
                                In this course you get
                            </h4>
                            <ul class="flex flex-col gap-2 py-4 text-gray-500">
                                <li
                                    class="flex items-center gap-3"
                                    v-for="Classes in showCourse.course_class"
                                    :key="Classes.id"
                                >
                                    <Icon
                                        name="streamline:interface-validation-check-circle-checkmark-addition-circle-success-check-validation-add-form"
                                        class="text-black"
                                    />
                                    {{ Classes.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <h3
                        class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8"
                    >
                        You might be interested in
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-7 my-8">
                        <CourseCard2
                            v-for="course in AllCourses.slice(0, 3)"
                            :key="course.id"
                            :course="course"
                        />
                    </div>
                </div>
            </div>
        </Container>
    </AppLayout>
</template>

<style scoped></style>
