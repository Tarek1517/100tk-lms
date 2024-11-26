

<script setup lang="ts">
import {ref} from 'vue'
const toggleNav = ref(false);
const notification = ref(false);
</script>

<template>
    <!--  phone nav bar-->
    <nav class="lg:hidden bg-white py-3 fixed top-0 left-0 right-0 z-40 w-full border-b border-primary overflow-hidden">
        <Container>
            <div class="flex items-center justify-between">
                <Link href="/">
                    <img class="h-auto w-12" src="@/assets/images/education-logo.png" >
                </Link>

                <div class="flex items-center gap-3">

                    <Link href="/" class=" text-sm font-medium text-primary px-3 py-1 rounded">
                        Login
                    </Link>
                    <button @click="notification = !notification">
                        <Icon name="ic:sharp-notifications" class=" text-xl text-primary" />
                    </button>
                    <button  @click="toggleNav = !toggleNav">
                        <Icon name="ic:twotone-menu" class="text-primary text-3xl"/>
                    </button>
                </div>
            </div>
        </Container>
    </nav>


    <div :class="{'translate-x-0': toggleNav, 'translate-x-80': !toggleNav}" class="fixed top-0 right-0 bottom-0 w-72 h-full z-50 lg:hidden transition-all ease-in-out duration-700
                         bg-primary border-2 border-gray-100 overflow-y-scroll">
        <div class="flex justify-between p-5 bg-primary">

            <button  @click="toggleNav = false">
                <Icon name="material-symbols:account-circle-full" class=" text-xl text-white" />
            </button>
            <button  @click="toggleNav = false">
                <Icon name="material-symbols:close-small" class=" text-4xl text-white" />
            </button>
        </div>
        <div>
            <ul>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/">
                        হোম পেজ
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        MCQ পরীক্ষার প্রস্তুতি
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        লিখিত পরীক্ষার প্রস্তুতি
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        স্কিল কো
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        ভর্তি পরীক্ষার প্রস্তুতি
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        একাডেমিক পড়াশোনা
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-2 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        পরীক্ষার ব্যাচ
                    </Link>
                </li>
            </ul>
        </div>
    </div>


    <!--  phone nav bar end-->
    <div :class="{'translate-x-0': notification, 'translate-x-80': !notification}" class="fixed top-0 right-0 bottom-0 w-72 h-full z-50 lg:hidden transition-all ease-in-out duration-700
                         bg-primary border-2 border-gray-100 overflow-y-scroll">
        <div class="flex justify-between p-5 bg-primary">

            <button  @click="notification = false">
                <Icon name="material-symbols:close-small" class=" text-4xl text-white" />
            </button>
            <div>
                <button class="bg-white text-xs px-2 py-1 font-semibold rounded-lg">
                    Mark all as Read
                </button>
            </div>
        </div>
        <div>
            <ul>
                <li class="bg-white text-center text-sm font-semibold py-3 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                        BCS পরীক্ষার ব্যাচ
                    </Link>
                </li>
                <li class="bg-white text-center text-sm font-semibold py-3 mx-6 mb-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-500">
                    <Link href="/category">
                         Bank পরীক্ষার ব্যাচ
                    </Link>
                </li>
            </ul>
        </div>
    </div>


</template>

























