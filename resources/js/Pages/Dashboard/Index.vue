<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex -mx-2">
          <div class="w-1/4 px-1">
              <div class="flex flex-col justify-between transparent bg-violet-800 h-36 rounded-xl p-5">
                  <div class="flex text-white items-center gap-2">
                      <Icon name="ph:student-bold" class="text-2xl" />
                      <h2 class=" text-2xl font-bold ">Total Students</h2>
                  </div>
                  <div class="flex justify-end items-end text-white">
                      <h4 class="text-2xl font-bold">2000+</h4>
                  </div>
              </div>
          </div>
          <div class="w-1/4 px-1">
              <div class="flex flex-col justify-between transparent bg-amber-600 h-36 rounded-xl p-5">
                  <div class="flex items-center text-white gap-2">
                      <Icon name="ph:student-bold" class="text-2xl" />
                      <h2 class="text-2xl font-bold">Total Students</h2>
                  </div>
                  <div class="flex justify-end text-white items-end">
                      <h4 class="text-2xl font-bold">2000+</h4>
                  </div>
              </div>
          </div>
          <div class="w-1/4 px-1">
              <div class="flex flex-col justify-between transparent bg-sky-500 h-36 rounded-xl p-5">
                  <div class="flex items-center text-white gap-2">
                      <Icon name="ph:student-bold" class=" text-2xl" />
                      <h2 class="text-2xl font-bold">Total Students</h2>
                  </div>
                  <div class="flex justify-end text-white items-end">
                      <h4 class="text-2xl font-bold">2000+</h4>
                  </div>
              </div>
          </div>
          <div class="w-1/4 px-1">
              <div class="flex flex-col justify-between transparent bg-pink-600 h-36 rounded-xl p-5">
                  <div class="flex items-center text-white gap-2">
                      <Icon name="ph:student-bold" class="text-2xl" />
                      <h2 class=" text-2xl font-bold">Total Students</h2>
                  </div>
                  <div class="flex justify-end text-white items-end">
                      <h4 class=" text-2xl font-bold">2000+</h4>
                  </div>
              </div>
          </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6" >
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-primary dark:bg-gray-700 dark:text-gray-400">
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
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-primary/15 hover:shadow-lg transition-all ease-in-out duration-300 dark:hover:bg-gray-600">
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
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">Bonnie Green</div>
                            <div class="font-normal text-gray-500">bonnie@flowbite.com</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        Designer
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">Jese Leos</div>
                            <div class="font-normal text-gray-500">jese@flowbite.com</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        Vue JS Developer
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">Thomas Lean</div>
                            <div class="font-normal text-gray-500">thomes@flowbite.com</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        UI/UX Engineer
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                        <div class="ps-3">
                            <div class="text-base font-semibold">Leslie Livingston</div>
                            <div class="font-normal text-gray-500">leslie@flowbite.com</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        SEO Specialist
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Offline
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </AuthenticatedLayout>
</template>
