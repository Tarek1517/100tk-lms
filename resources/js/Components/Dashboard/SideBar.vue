<script setup>

</script>

<template>
       <div class="top-0 left-0 w-60 bg-white fixed h-screen border-r shadow-lg pt-24 ">

           <ul class="flex flex-col text-gray-500 text-base font-bold tracking-wide leading-loose px-5">
               <!-- Dashboard  -->
               <li>
                   <Link href="/"  class="group flex items-center gap-3  cursor-pointer relative p-2.5 active
                        hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500">
                       <Icon name="bxs:dashboard"  class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500" />
                       <span class=" group-hover:text-primary transition-all ease-in-out duration-500">Dashboard</span>
                   </Link>
               </li>
               <li>
                   <Link href="/" class="group flex items-center gap-3  cursor-pointer relative p-2.5
                        hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500">

                       <Icon name="ph:student-fill"  class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500" />
                       <span class=" group-hover:text-primary transition-all ease-in-out duration-500">Student</span>
                   </Link>
               </li>
               <li>
                   <Link href="/" class="group flex items-center gap-3  cursor-pointer relative p-2.5
                        hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500">
                       <Icon name="material-symbols:book-5"  class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500" />
                       <span class=" group-hover:text-primary transition-all ease-in-out duration-500">Courses</span>
                   </Link>
               </li>
               <li>
                   <Link href="/"  class="group flex items-center gap-3  cursor-pointer relative p-2.5
                        hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500">
                       <Icon name="tabler:category"  class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500" />
                       <span class=" group-hover:text-primary transition-all ease-in-out duration-500">Course Categories</span>
                   </Link>
               </li>
               <!-- Setting -->
               <li>
                   <Link href="/" class="group flex items-center gap-3  cursor-pointer relative p-2.5
                        hover:bg-primary/10 hover:rounded-lg transition-all ease-in-out duration-500">
                       <Icon name="hugeicons:settings-02" class="text-2xl group-hover:text-primary transition-all ease-in-out duration-500" />
                       <span class=" group-hover:text-primary transition-all ease-in-out duration-500">Settings</span>
                   </Link>
               </li>
           </ul>
       </div>
</template>
