<script setup>

import Icon from "@/Components/Icon.vue";
</script>

<template>
    <div class=" fixed top-0 bg-white left-0 right-0 z-50 border-b shadow-lg">

            <div class="flex items-center justify-between py-3 px-12">
                <Link href="/dashboard" class="flex items-center gap-2">
                    <span  class="text-white">
                        <img class="w-auto h-12" src="@/assets/images/education-logo.png">
                    </span>

                </Link>
               <div class="flex gap-3">
                   <span class="bg-primary size-9 rounded-full  flex items-center justify-center">
                       <Icon name="icon-park-solid:people-right" class="text-white text-sm" />
                   </span>
                   <ul>
                       <li class="text-xs text-primary font-medium">
                           Administrator
                       </li>
                       <li class="text-base font-medium text-gray-600">
                           Tushar Imran Khan Babu
                       </li>
                   </ul>
               </div>
            </div>


    </div>
</template>
