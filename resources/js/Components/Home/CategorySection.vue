<script setup>

import Container from "@/Components/Container.vue";
</script>

<template>
    <section class="lg:py-20">
        <Container>
            <div class="flex flex-wrap lg:-mx-8">
                <div class="w-full lg:w-1/2 px-8">
                    <div>
                        <ul class="w-full mb-6" v-for="item in 5">
                            <li class="flex gap-4 justify-end">
                               <div class=" lg:p-4 lg:text-end order-last lg:order-none">
                                    <h2 class="font-bold text-base lg:text-xl">Lorem ipsum dolor sit amet.</h2>
                                   <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                               </div>
                                <div class="flex items-center order-first lg:order-none">
                                    <span class="size-16 lg:size-20 bg-primary text-white font-bold text-base lg:text-2xl rounded-full border flex items-center justify-center">
                                        BCS
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-8">
                    <div>
                        <ul class="w-full mb-6" v-for="item in 5">
                            <li class="flex gap-4 ">
                                <div class="flex items-center">
                                    <span class="size-16 lg:size-20 bg-primary text-white font-bold text-base lg:text-2xl rounded-full border flex items-center justify-center">
                                        BCS
                                    </span>
                                </div>
                                <div class=" lg:p-4 ">
                                    <h2 class="font-bold text-base lg:text-xl">Lorem ipsum dolor sit amet.</h2>
                                    <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </Container>
    </section>

</template>

