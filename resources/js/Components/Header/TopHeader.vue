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
    <section class="bg-[#1F2C30] py-2">
        <Container>
            <div class="flex justify-between">
                <div class="flex gap-4">
                    <div
                        class="flex items-center text-base font-semibold text-white gap-1"
                    >
                        <Icon name="mdi-light:phone" />
                        <p
                            class="hover:text-primary transition-all ease-in-out duration-500"
                        >
                            {{ settings.phone }}
                        </p>
                    </div>
                    <span class="border-r-2 border-gray-700"></span>
                    <div
                        class="flex items-center text-base font-semibold text-white gap-1"
                    >
                        <Icon name="mi:location" class="text-lg" />
                        <p
                            class="hover:text-primary transition-all ease-in-out duration-500"
                        >
                            {{ settings.address }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div
                        v-if="page.props?.auth?.validStudent"
                        class="flex items-center text-base font-semibold text-white"
                    >

                        <Link
                            :href="`/students/${user.id}`"
                            class="hover:text-primary rounded text-white flex items-center"
                        >
                        <Icon name="material-symbols:person" class="text-xl mr-1" />
                            {{ user.name }}
                        </Link>

                    </div>
                    <div
                        v-else
                        class="flex items-center text-base font-semibold text-white gap-2"
                    >
                        <Icon name="material-symbols:person" class="text-xl" />
                        <Link
                            href="/Student/Login"
                            class="hover:text-primary transition-all ease-in-out duration-500 hover:bg-white bg-primary rounded px-2 text-white"
                        >
                            Login
                        </Link>
                        <Link
                            href="/Student/Register"
                            class="hover:text-primary transition-all ease-in-out duration-500 hover:bg-white bg-primary rounded px-2 text-white"
                        >
                            Register
                        </Link>
                    </div>
                    <!-- If user is authenticated -->

                    <span class="border-r-2 border-gray-700"></span>
                    <div
                        class="flex items-center text-base font-semibold text-white gap-3"
                    >
                        <p class="">Follow Us</p>
                        <Icon
                            name="ri:facebook-fill"
                            class="text-xl hover:text-primary transition-all ease-in-out duration-500"
                        />
                        <Icon
                            name="ri:instagram-line"
                            class="text-xl hover:text-primary transition-all ease-in-out duration-500"
                        />
                        <Icon
                            name="basil:skype-solid"
                            class="text-xl hover:text-primary transition-all ease-in-out duration-500"
                        />
                        <Icon
                            name="uil:youtube"
                            class="text-xl hover:text-primary transition-all ease-in-out duration-500"
                        />
                    </div>
                </div>
            </div>
        </Container>
    </section>
</template>
