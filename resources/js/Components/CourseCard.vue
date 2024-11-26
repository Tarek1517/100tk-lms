<script setup>

</script>

<template>
        <div class="rounded-xl border">
            <div class="p-3 lg:p-7 ">
                <Link href="/" class="w-full h-[270px] rounded-xl overflow-hidden">
                    <img class="w-full h-full object-cover rounded-xl" src="https://images.pexels.com/photos/2781814/pexels-photo-2781814.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                </Link>
                <div class="pt-3 lg:pt-7">
                    <h2 class="text-base lg:text-xl font-semibold  hover:text-primary transition-all ease-in-out duration-500">Lorem ipsum dolor sit amet, consectetur adipisicing.</h2>
                    <ul class="flex flex-wrap gap-1 lg:gap-7 pt-3 lg:pt-7 text-gray-400">
                        <li class="flex items-center gap-1 font-medium text-xs lg:text-base text-nowrap">
                            <Icon name="solar:notebook-minimalistic-broken" class="text-xl" />
                            Lesson 8
                        </li>
                        <li class="flex items-center gap-1 font-medium text-xs lg:text-base text-nowrap">
                            <Icon name="ph:student-thin" class="text-xl" />
                            Students 50
                        </li>
                        <li class="flex items-center gap-1 font-medium text-xs lg:text-base text-nowrap">
                            <Icon name="mdi-light:eye" class="text-xl" />
                            View: 12K
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 lg:gap-0 justify-between p-3 lg:p-7 border-t">
                <p class="text-xl font-semibold text-primary">100৳</p>
                <Link href="/" class="text-sm lg:text-base font-semibold px-4 py-1 border rounded-full  hover:border-primary transition-all ease-in-out duration-500">View Details</Link>
            </div>
        </div>


</template>
