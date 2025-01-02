<script setup>
import Section from "@/Components/Home/Section.vue";
import Container from "@/Components/Container.vue";
const props = defineProps({
    settings: Object,
});
</script>

<template>
    <section class="bg-gray-600">
        <Container>
            <div class="flex flex-col lg:flex-row py-10">
                <div class="w-full lg:w-1/4">
                    <div class="text-center lg:text-left">
                        <Link href="/">
                            <img
                                class="w-24 h-auto p-1 mb-6 mx-auto lg:mx-0"
                                src="@/assets/images/education-logo.png"
                                alt=""
                            />
                        </Link>
                        <h2
                            class="text-lg lg:text-xl font-bold lg:leading-snug text-white my-3"
                        >
                            দেশের সেরা প্রতিষ্ঠান থেকে <br />
                            শেখা শুরু করুন
                        </h2>
                    </div>
                </div>

                <div
                    class="w-full lg:w-1/4"
                    v-for="column in settings?.footer_columns"
                    :key="column.id"
                >
                    <div
                        class="flex justify-center lg:justify-start gap-5 lg:gap-10 pt-6 lg:pt-0 mb-5 lg:mb-0"
                    >
                        <div class="text-center lg:text-left text-white">
                            <h2 class="text-xl font-bold mb-5">
                                {{ column?.title }}
                            </h2>
                            <ul class="font-medium text-sm lg:text-base">
                                <li
                                    v-for="page in column?.pages || []"
                                    :key="page?.slug"
                                >

                                    <a
                                        v-if="page?.slug && page?.title"
                                        :to="`/${page.slug}`"
                                        class="font-medium text-sm lg:text-base hover:text-secondary lg:pb-3"
                                    >
                                        {{ page.title  || "No Name Provided" }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/4">
                    <div
                        class="text-center lg:text-left text-white pt-6 lg:pt-0"
                    >
                        <h2 class="text-xl font-bold mb-5">যোগাযোগ</h2>
                        <ul class="text-sm lg:text-base">
                            <li class="lg:pb-3">
                                Call Us: IB ** (10am - 10pm)
                            </li>
                            <li class="lg:pb-3">whatsapp: +880 1870 729 192</li>
                            <li class="lg:pb-3">
                                Email: 100tkedu.info@gmail.com
                            </li>
                        </ul>
                    </div>
                    <div></div>
                </div>
            </div>
            <div
                class="flex items-center justify-center text-sm lg:text-base text-white py-4"
            >
                <p class="text-center">
                    2024 Copyright © 100Taka-LMS. All rights reserved.
                </p>
            </div>
        </Container>
    </section>
</template>
