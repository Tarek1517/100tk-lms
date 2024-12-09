<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Section from "@/Components/Home/Section.vue";
import CourseCard from "@/Components/CourseCard.vue";
import Container from "@/Components/Container.vue";
</script>

<template>
    <AppLayout>
        <section class="">
            <div>
                <div class="w-full h-52 lg:h-96 ">
                    <img class=" w-full h-full object-cover" src="../../../assets/images/banner.png" alt="">
                    <h2 class="text-3xl lg:text-5xl font-semibold text-white text-center -mt-28 lg:-mt-52">MCQ পরীক্ষার প্রস্তুতি</h2>
                </div>
                <Container>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-5 my-12 " >
                        <CourseCard v-for="item in 12" />
                    </div>
                </Container>
            </div>
        </section>
    </AppLayout>
</template>
