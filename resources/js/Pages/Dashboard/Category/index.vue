<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "vue3-toastify";

const props = defineProps({
    allCategories: Array,
});

// Deleting a category
const deleteCategory = async (categoryId) => {
    try {
        await Inertia.delete(`/dashboard/category/${categoryId}`);

        toast.success("Category Deleted Successfully", { autoClose: 3000 });
    } catch (error) {
        toast.error("Failed to delete category", { autoClose: 3000 });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            class="text-lg"
                        />
                        <h3 class="text-lg font-medium">Course Category</h3>
                    </div>
                    <div>
                        <Link
                            href="/dashboard/category/create"
                            class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal"
                        >
                            <Icon name="material-symbols:add-box-outline" />
                            Add Record
                        </Link>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-base-color">
                    <Search />
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-3 py-3">Name</th>
                            <th scope="col" class="px-3 py-3">Subtitle</th>
                            <th scope="col" class="py-3">Parent Category</th>
                            <th scope="col" class="py-3">Order Number</th>

                            <th scope="col" class="px-3 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 hover:shadow-lg transition-all ease-in-out duration-300 dark:hover:bg-gray-600"
                            v-for="Category in allCategories" :key="Category.id"
                        >
                            <td
                                scope="row"
                                class="flex items-center px-5 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                <img
                                    :src="
                                        Category.image
                                            ? `/storage/img/${Category.image}`
                                            : '/images/default.png'
                                    "
                                    alt="Category Image"
                                    class="w-10 h-10 object-cover"
                                />
                            </td>
                            <td class="py-1">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ Category.name }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ Category.subtitle }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="flex items-center">
                                    <div class="text-sm font-normal text-black">
                                        {{
                                            Category.parent?.name ?? "No Parent"
                                        }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-1">
                                <div class="flex items-center">
                                    <div class="text-sm font-normal text-black">
                                        {{ Category.order_number }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-1">
                                <div class="flex items-center gap-2">
                                    <Link
                                        :href="`/dashboard/category/${Category.id}/edit`"
                                        method="get"
                                        class="text-white font-semibold hover:bg-secondary bg-primary px-2 py-1 rounded-sm"
                                    >
                                        <Icon
                                            name="material-symbols:edit-square-outline"
                                            class="text-lg text-white group-hover:text-secondary"
                                        />
                                    </Link>

                                    <Link
                                        @click.prevent="
                                            deleteCategory(Category.id)
                                        "
                                        class="text-white font-semibold hover:bg-secondary bg-rose-500 px-2 py-1 rounded-sm"
                                    >
                                        <Icon
                                            name="material-symbols:delete-outline"
                                            class="text-lg group-hover:text-secondary"
                                        />
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
