<script setup>

</script>

<template>
    <section class="bg-slate-100">
        <Container>
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center gap-2">
                    <div class="w-16 h-16">
                        <img class="w-full h-auto" src="@/assets/images/education-logo.png" alt="">
                    </div>
                    <p class="text-2xl font-bold ">100৳ -<span class="font-normal">LMS</span> </p>
                </div>
                <div>
                    <ul class="flex gap-7 text-sm font-medium">
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/"> হোম পেজ </Link> </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category"> MCQ পরীক্ষার প্রস্তুতি </Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category"> লিখিত পরীক্ষার প্রস্তুতি</Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category"> স্কিল কোর্স</Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category">ভর্তি পরীক্ষার প্রস্তুতি</Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category">একাডেমিক পড়াশোনা</Link>
                        </li>
                        <li class="hover:text-primary transition-all ease-in-out duration-500">
                            <Link href="/category">পরীক্ষার ব্যাচ</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </Container>
    </section>
</template>
