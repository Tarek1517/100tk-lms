<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "vue3-toastify";

const props = defineProps({
    Allpages: Array,
});

// Deleting a category
const deletePage = async (PageId) => {
    try {
        await Inertia.delete(`/dashboard/page/${PageId}`);

        toast.success("Page Deleted Successfully", { autoClose: 3000 });
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
                        <h3 class="text-lg font-medium">Pages</h3>
                    </div>
                    <div>
                        <Link
                            href="/dashboard/page/create"
                            class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal"
                        >
                            <Icon name="material-symbols:add-box-outline" />
                            Add Record
                        </Link>
                    </div>
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
                            <th scope="col" class="px-3 py-3">Title</th>
                            <th scope="col" class="px-3 py-3">Slug</th>
                            <th scope="col" class="py-3">Created at</th>
                            <th scope="col" class="px-3 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="page in Allpages"
                            :key="page.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 hover:shadow-lg transition-all ease-in-out duration-300 dark:hover:bg-gray-600"
                        >
                            <td class="py-4">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ page.title }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-4">
                                <div class="ps-3">
                                    <div class="text-sm font-normal text-black">
                                        {{ page.slug }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-normal text-black">
                                        {{ page.created_at }}
                                    </div>
                                </div>
                            </td>

                            <td class="py-4">
                                <div class="flex items-center gap-2">
                                    <Link
                                        :href="`/dashboard/page/${page.id}/edit`"
                                        method="get"
                                        class="text-white font-semibold hover:bg-secondary bg-primary px-2 py-1 rounded-sm"
                                    >
                                        <Icon
                                            name="material-symbols:edit-square-outline"
                                            class="text-lg group-hover:text-secondary"
                                        />
                                    </Link>

                                    <Link
                                        @click.prevent="deletePage(page.id)"
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
