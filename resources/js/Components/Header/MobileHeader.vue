

<script setup>
import {ref} from 'vue'
const toggleNav = ref(false);
const notification = ref(false);
const search = ref(false);
</script>

<template>
    <!--  phone nav bar-->
    <nav class="lg:hidden bg-white  w-full border-b border-primary">
        <Container>
            <div class="flex items-center py-3 justify-between">
                <Link href="/">
                    <img class="h-auto w-12" src="@/assets/images/education-logo.png" >
                </Link>

                <div class="flex items-center gap-3">
                    <button @click="search = !search">
                        <Icon name="rivet-icons:magnifying-glass" class=" right-3 text-primary text-xl" />
                    </button>
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
        <div class=" bg-primary py-3 px-2 relative">
            <Container>
                <ul class="flex justify-between text-white">
                    <li class="flex items-center relative group text-xs transition-all ease-in-out duration-500">
                        চাকরি প্রস্তুতি
                        <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                        <div class="absolute bg-white rounded-lg w-44 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-8 transition-all ease-in-out duration-500 -right-[78px]">
                            <ul class="flex flex-col gap-3 shadow-lg font-normal text-black p-2">
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> বিসিএস</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                <li class="border-b"></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                            </ul>
                        </div>
                    </li>
                    <li class="flex items-center relative group text-xs transition-all ease-in-out duration-500">
                        ভর্তির প্রস্তুতি
                        <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                        <div class="absolute bg-white rounded-lg w-44 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-8 transition-all ease-in-out duration-500 right-2">
                            <ul class="flex flex-col gap-3 shadow-lg font-normal p-2 text-black">

                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                <li class="border-b"></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                            </ul>
                        </div>
                    </li>
                    <li class="hover:text-primary text-xs transition-all ease-in-out duration-500">
                        <Link href="/category"> স্কিল কোর্স</Link>
                    </li>
                    <li class=" text-xs  group">
                        <div class="flex items-center">
                            আরো
                            <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                        </div>
                        <div class="absolute bg-white rounded-lg w-44 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-12 transition-all ease-in-out duration-500 right-2">
                            <ul class="flex flex-col gap-3 shadow-lg text-xs font-normal p-2 text-black">
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">পরীক্ষার ব্যাচ</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> MCQ পরীক্ষা</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> একাডেমিক পড়াশোনা</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                <li class="border-b"></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </Container>
        </div>
    </nav>
<!--    Search Box -->
    <div :class="{'z-40 top-28 opacity-100': search, '-z-40 -top-10 opacity-0': !search}" class="fixed border-primary left-0 right-0  w-full transition-all ease-in-out duration-500">
        <div class="flex items-center relative m-2 " >
            <Icon name="rivet-icons:magnifying-glass" class="absolute right-3 text-primary text-xl" />
            <input type="text" id="table-search-users"
                   class="block p-2 ms-2 ps-3 text-sm border rounded-xl text-primary w-full bg-white placeholder-slate-700 focus:ring-0 focus:border-primary focus:outline-0"
                   placeholder="100 টাকার course খুঁজুন">
        </div>
    </div>

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

























