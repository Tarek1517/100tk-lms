<script setup lang="ts">

import CourseCard from "@/Components/CourseCard.vue";
</script>

<template>
    <AppLayout>
        <Container>
            <div class="flex flex-wrap py-12 lg:-mx-8 bg-[url('https://html.rrdevs.net/edcare/assets/img/shapes/hero-shape-3.png')] bg-no-repeat">
                <div class="w-full lg:w-3/5 lg:px-8 ">
                    <div class="pt-8 lg:pt-0">
                        <h2 class="text-3xl lg:text-6xl font-bold">Run Your First Course with 100Taka LMS </h2>
                        <p class="text-sm text-gray-500 py-8 max-w-xl leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam aperiam beatae dolorem ducimus et expedita fugit harum illo impedit libero magni mollitia natus nulla numquam, officia porro praesentium recusandae saepe temporibus totam velit veritatis, voluptas voluptatem, voluptatibus. At blanditiis cum, cupiditate deleniti dolores ea et ex hic ipsa laudantium minus officiis placeat quidem quod, sequi suscipit ut! Aliquam aliquid at dicta maxime provident quae quo quod quos ut vitae!
                        </p>
                        <div>
                            <h3 class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8">Study Plan</h3>
                            <ul class="flex flex-wrap gap-2  py-4 text-gray-500  border border-secondary rounded-lg my-9 ">
                                <li class="flex items-center gap-3 px-4" v-for="item in 7">
                                    <Icon name="line-md:confirm-circle-to-circle-twotone-transition" class="text-primary " />
                                    ১ সপ্তাহের স্টাডি প্ল্যান
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8">About Course</h3>
                            <p class="text-sm text-gray-500 py-8 max-w-xl leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aperiam aut consequatur debitis distinctio dolorem eos error eveniet facilis id in ipsum magnam maiores, modi mollitia nam nemo nesciunt nihil, numquam odit optio praesentium quas qui rerum sapiente ut veritatis voluptatibus? Aliquid culpa cum exercitationem laudantium, libero minus quo. Ad aliquid animi blanditiis commodi dignissimos, dolore doloremque doloribus dolorum ducimus eaque earum esse et ex excepturi expedita explicabo harum inventore ipsa iure mollitia nam necessitatibus neque officia pariatur placeat provident quibusdam quidem repellat reprehenderit sed sequi sit tempore totam unde ut veniam vitae! Accusamus aliquid ex nulla repellendus veniam. Fuga.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-2/5 lg:px-8 order-first lg:order-none pt-6 lg:pt-0">
                    <div class="border rounded-lg " >
                        <div class="w-full h-80">
                            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/7947716/pexels-photo-7947716.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                        </div>
                        <div class="p-4">
                            <h2 class="text-3xl font-bold text-primary"> Fee ৳ 100</h2>
                            <div class=" border-b">
                                <Link href="/" class="flex items-center justify-center text-white gap-2 bg-secondary hover:bg-primary
                                 w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500">
                                    Enroll Now This Course <Icon name="material-symbols:arrow-forward-ios-rounded" />
                                </Link>
                            </div>
                            <h4 class="text-base font-semibold pt-5 text-gray-500">In this course you get</h4>
                            <ul class="flex flex-wrap gap-2  py-4 text-gray-500 -mx-3">
                                <li class="flex items-center gap-3 px-4" v-for="item in 7">
                                    <Icon name="streamline:interface-validation-check-circle-checkmark-addition-circle-success-check-validation-add-form" class="text-black " />
                                    ১ সপ্তাহের স্টাডি প্ল্যান
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl lg:text-4xl font-bold border-b pb-3 mt-8 ">You might be interested in</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-7 my-8 " >
                        <CourseCard v-for="item in 3" />
                    </div>
                </div>
            </div>
        </Container>
    </AppLayout>
</template>

<style scoped>

</style>
