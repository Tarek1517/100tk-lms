<script setup>
    import { defineProps} from 'vue'
    import Container from "@/Components/Container.vue";
    const props = defineProps({
        title: String,
        courses: Array,
        viewDetails: String,
    })

    import { Swiper, SwiperSlide,  } from 'swiper/vue';

    // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/navigation';

    // import required modules
    import {Navigation,Autoplay } from 'swiper/modules';
    import CourseCard from "@/Components/CourseCard.vue";
    import Icon from "@/Components/Icon.vue";

    const modules = [Navigation,Autoplay]

</script>

<template>
    <section>
       <Container>
           <div>
               <h1 class="text-2xl font-semibold py-10">{{ title }}</h1>
           </div>
           <div>
               <swiper
                   :breakpoints="{
                        '320': {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        '768': {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        },
                        '1024': {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                    }"

               :navigation="true"
               :modules="modules"
               :autoplay= "{
                delay: 2000,
                disableOnInteraction: true,
                }"
               class="mySwiper"
               >
                   <swiper-slide v-for="course in courses" :key="course.id">
                        <CourseCard :course="course" />
                   </swiper-slide>
               </swiper>
           </div>
           <div class="flex justify-end">
               <button v-if="viewDetails" class="flex items-center gap-3 border border-secondary text-secondary px-4 py-1 text-lg font-normal my-10 rounded hover:text-primary transition-all ease-in-out duration-500">
                   {{ viewDetails }}
                   <Icon name="material-symbols:line-end-arrow-notch" class="text-xl text-primary" />
               </button>

           </div>
       </Container>
    </section>
</template>
