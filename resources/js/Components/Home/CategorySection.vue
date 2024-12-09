<script setup>

import Container from "@/Components/Container.vue";
</script>

<template>
    <section class="">

        <Container>
            <div class="">
                <div class="relative z-20 grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-7  ">
                    <div class=" p-4 h-44 flex flex-col items-center justify-center shadow-xl  relative  rounded-xl overflow-hidden
                         bg-[url('https://img.freepik.com/premium-vector/back-school-background_42775-128.jpg?ga=GA1.1.1129155627.1730873252&semt=ais_hybrid')]"
                            v-for="item in 8" >
                        <span class="absolute w-full h-full left-0 right-0 bottom-0 top-0 bg-black opacity-50"></span>
                        <div class="relative z-10 text-center">
                            <h2 class="font-bold text-sm lg:text-xl mb-3 text-white">ভর্তি পরীক্ষার প্রস্তুতি</h2>
                            <p class="text-xs lg:text-sm text-gray-400">MCQ পরীক্ষার প্রস্তুতি একাডেমিক পড়াশোনা একাডেমিক পড়াশোনা</p>
                        </div>
                    </div>
                </div>
            </div>
        </Container>
    </section>

</template>

