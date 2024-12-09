<script setup>

import Section from "@/Components/Home/Section.vue";
import Container from "@/Components/Container.vue";
</script>

<template>
    <section class="bg-gray-600">
        <Container>
            <div class="flex flex-col lg:flex-row py-10 ">
                <div class="w-full lg:w-1/4">
                    <div class="text-center lg:text-left">
                        <Link href="/">
                            <img class="w-24 h-auto p-1 mb-6 mx-auto lg:mx-0" src="@/assets/images/education-logo.png" alt="" />
                        </Link>
                        <h2 class="text-lg lg:text-xl font-bold lg:leading-snug text-white my-3">দেশের সেরা প্রতিষ্ঠান থেকে <br>   শেখা শুরু করুন</h2>
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <div class="flex justify-center lg:justify-start gap-5 lg:gap-10 pt-6 lg:pt-0 mb-5 lg:mb-0" >
                        <div class="text-center lg:text-left text-white">
                            <h2 class="text-xl font-bold mb-5">আমাদের সম্পর্কে</h2>
                            <ul class="font-medium text-sm lg:text-base ">
                                <li class="hover:text-secondary lg:pb-3"><Link href ="/">Company info.</Link></li>
                                <li class="hover:text-secondary lg:pb-3"><Link href ="/">FAQs</Link></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <div class="text-center lg:text-left text-white">
                        <h2 class="text-xl font-bold mb-5">আমাদের নীতি</h2>
                        <ul class="font-medium text-sm lg:text-base ">
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Enroll Rule</Link></li>
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Refunding Policy</Link></li>
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Class Rules</Link></li>
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Payment Rules</Link></li>
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Terms</Link></li>
                            <li class="hover:text-secondary lg:pb-3"><Link href="/">Conditions</Link></li>
                        </ul>
                    </div>
                </div>
                <div class="w-full lg:w-1/4">
                    <div class=" text-center lg:text-left text-white pt-6 lg:pt-0">
                        <h2 class="text-xl font-bold mb-5">যোগাযোগ</h2>
                        <ul class="text-sm lg:text-base">
                            <li class="lg:pb-3">Call Us:  IB ** (10am - 10pm)</li>
                            <li class="lg:pb-3">whatsapp:  +880 1870 729 192</li>
                            <li class="lg:pb-3">Email:  100tkedu.info@gmail.com</li>
                        </ul>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center text-sm lg:text-base text-white py-4" >
                <p class="text-center">2024 Copyright © 100Taka-LMS. All rights reserved.</p>
            </div>
        </Container>
    </section>
</template>
