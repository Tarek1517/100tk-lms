<script setup>

</script>

<template>
    <section class="bg-slate-100">
        <Container>
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center gap-2">
                    <Link href="/" class="w-16 h-16">
                        <img class="w-full h-auto" src="@/assets/images/education-logo.png" alt="">
                    </Link>
                    <div class="flex items-center relative">
                        <Icon name="rivet-icons:magnifying-glass" class="absolute right-3 text-primary text-xl" />
                        <input type="text" id="table-search-users"
                               class="block p-2 ms-2 ps-3 text-sm border rounded-xl text-primary w-80 bg-white  focus:ring-0 focus:border-primary focus:outline-0"
                               placeholder="100 টাকার কোর্ খুঁজুন">
                    </div>
                </div>
                <div>
                    <ul class="flex gap-7 text-sm font-medium">
                        <li class="flex items-center relative group  transition-all ease-in-out duration-500">
                            চাকরি প্রস্তুতি
                            <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                            <div class="absolute bg-white shadow-lg rounded-lg w-52 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-8 transition-all ease-in-out duration-500 right-2">
                                <ul class="flex flex-col gap-3 text-sm font-normal p-2">
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> বিসিএস </Link></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block  p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                    <li class="border-b"></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                                </ul>
                            </div>
                        </li>
                        <li class="flex items-center relative group  transition-all ease-in-out duration-500">
                             ভর্তি পরীক্ষার প্রস্তুতি
                                <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                                <div class="absolute bg-white shadow-lg rounded-lg w-52 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-8 transition-all ease-in-out duration-500 right-2">
                                    <ul class="flex flex-col gap-3 text-sm font-normal  p-2">
                                        <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> বিসিএস </Link></li>
                                        <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                        <li class="border-b"></li>
                                        <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                        <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                                        <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                    </ul>
                                </div>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category"> স্কিল কোর্স</Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category">ক্লাস 6-12 </Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category">পরীক্ষার ব্যাচ</Link>
                        </li>
                        <li class="flex items-center relative group   transition-all ease-in-out duration-500">
                            আরো
                            <Icon name="material-symbols:keyboard-arrow-down-rounded" class="text-lg" />
                            <div class="absolute bg-white rounded-lg shadow-lg w-52 -z-50 group-hover:z-50 opacity-0 group-hover:opacity-100 top-12 transition-all ease-in-out duration-500 right-2">
                                <ul class="flex flex-col gap-3 text-sm font-normal p-4">
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> একাডেমিক পড়াশোনা</Link></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">ভর্তি পরীক্ষার প্রস্তুতি</Link></li>
                                    <li class="border-b"></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg"> লিখিত পরীক্ষার প্রস্তুতি</Link></li>
                                    <li><Link href="/category" class="hover:bg-primary hover:text-white transition-all ease-in-out duration-500 w-full block p-2 rounded-lg">MCQ পরীক্ষার প্রস্তুতি</Link></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </Container>
    </section>
</template>
