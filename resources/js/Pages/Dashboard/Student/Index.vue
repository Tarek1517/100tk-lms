<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
</script>

<template>
    <AuthenticatedLayout>
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Icon name="carbon:ibm-data-product-exchange" class="text-lg " />
                        <h3 class="text-lg font-medium">Students</h3>
                    </div>
                    <div>
                        <Link href="/" class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal">
                            <Icon name="material-symbols:add-box-outline" />
                            Add Record
                        </Link>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-base-color">
                    <Search />
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6" >
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Position
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-primary/15 hover:shadow-lg
                            transition-all ease-in-out duration-300 dark:hover:bg-gray-600" v-for="item in 7">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese image">
                            <div class="ps-3">
                                <div class="text-base font-semibold">Neil Sims</div>
                                <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            React Developer
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <Link href="/" class="w-8 h-8 rounded-md flex items-center justify-center  bg-primary  border border-gray-300/30 hover:border-gray-300 group">
                                        <Icon name="material-symbols-light:rule-settings-rounded" class="text-xl text-white group-hover:text-secondary" />
                                    </Link>
                                    <Link to="/" class="w-8 h-8 rounded-md flex items-center justify-center bg-primary  border border-gray-300/30 hover:border-gray-300 group">
                                        <Icon name="material-symbols:edit-square-outline" class="text-lg  text-white group-hover:text-secondary" />
                                    </Link>
                                    <button class="w-8 h-8 rounded-md flex items-center justify-center bg-primary border border-gray-300/30 hover:border-gray-300 group">
                                        <Icon name="material-symbols:delete-outline" class="text-lg text-white group-hover:text-secondary" />
                                    </button>
                                </div>
                            </td>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
