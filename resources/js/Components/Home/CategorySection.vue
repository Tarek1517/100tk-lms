<script setup>
import Container from "@/Components/Container.vue";
import { defineProps } from "vue";

const props = defineProps({
    home_categories: Array,
});
</script>

<template>
    <section>
        <Container>
            <div>
                <div
                    class="relative z-20 grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-7"
                >
                    <div
                        class="p-4 h-44 flex flex-col items-center justify-center shadow-xl relative rounded-xl overflow-hidden"
                        v-for="Category in home_categories"
                        :key="Category.id"
                        :style="{
                            backgroundImage: `url('/storage/img/${Category.image}')`,
                            backgroundSize: 'cover',
                            backgroundPosition: 'center',
                        }"
                    >
                        <span
                            class="absolute w-full h-full left-0 right-0 bottom-0 top-0 bg-black opacity-50"
                        ></span>
                        <div class="relative z-10 text-center">
                            <h2
                                class="font-bold text-sm lg:text-xl mb-3 text-white"
                            >
                                {{ Category.name }}
                            </h2>
                            <p class="text-xs lg:text-sm text-gray-400">
                                {{ Category.subtitle }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </Container>
    </section>
</template>
