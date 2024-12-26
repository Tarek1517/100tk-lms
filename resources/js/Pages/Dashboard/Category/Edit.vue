<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { toast } from "vue3-toastify";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";


const props = defineProps({
    editCategory: Object,
    parentCategories: Array,
});

const onImageSelected = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.imagePreview = URL.createObjectURL(file);
        form.image = file;
    }
};

const form = useForm({
    _method: "put",
    name: props.editCategory.name || "",
    parent_id: props.editCategory.parent_id || "",
    image: null,
    imagePreview: props.editCategory.image
        ? `/storage/img/${props.editCategory.image}`
        : null,
    order_number: props.editCategory.order_number || 0,
    subtitle: props.editCategory.subtitle || "",
});

const onUpdate = () => {
    form.post(`/dashboard/category/${props?.editCategory?.id}`, {
        forceFormData: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div
                    class="flex flex-col items-center justify-center text-xs text-white bg-secondary dark:bg-gray-700 dark:text-gray-400 mb-10 p-3 text-center rounded-md font-semibold"
                >
                    <div class="flex items-center gap-3">
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            class="text-lg"
                        />
                        <h3 class="text-lg font-medium">Update Category</h3>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <div class="shadow-lg rounded-lg p-4 max-w-3xl mx-auto">
                    <form @submit="onUpdate">
                        <div>
                            <div class="flex items-center flex-wrap">
                                <!-- Category Name -->
                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Category Name</label
                                    >
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>

                                <!-- Parent Category -->
                                <div class="w-full">
                                    <label
                                        for="parentCategory"
                                        class="text-sm block mb-2"
                                        >Select Parent Category</label
                                    >
                                    <select
                                        v-model="form.parent_id"
                                        class="w-full border border-primary rounded-md focus:outline-none focus:ring-2 focus:ring-secondary"
                                    >
                                    <option value="" disabled>
                                            Select a category
                                        </option>
                                        <option
                                            v-for="parentCategory in parentCategories"
                                            :key="parentCategory.id"
                                            :value="parentCategory.id"
                                        >
                                            {{ parentCategory.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Category Subtitle -->
                                <div class="w-full">
                                    <label
                                        for="subtitle"
                                        class="text-sm block mb-2"
                                        >Category Subtitle</label
                                    >
                                    <input
                                        v-model="form.subtitle"
                                        type="text"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>

                                <!-- Order Number -->
                                <div class="w-full">
                                    <label
                                        for="orderNumber"
                                        class="text-sm block mb-2"
                                        >Order Number</label
                                    >
                                    <input
                                        v-model="form.order_number"
                                        type="number"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>
                            </div>
                           
                            <!-- Image Upload Section -->
                            <div
                                class="flex items-center my-10 border border-primary border-dotted p-3 rounded-md"
                            >
                                <div class="w-full">
                                    <label
                                        for="category-icon"
                                        class="text-sm block mb-2"
                                        >Category Image</label
                                    >
                                    <label
                                        class="border border-common border-dashed p-4 rounded-2xl flex items-center justify-center w-full h-52 cursor-pointer"
                                    >
                                        <!-- Image Preview -->
                                        <img
                                            v-if="form.imagePreview"
                                            :src="form.imagePreview"
                                            alt="Category Image Preview"
                                            class="w-1/3 h-auto mb-5"
                                        />
                                        <!-- If No Image Selected -->
                                        <div
                                            v-if="!form.imagePreview"
                                            class="flex flex-col items-center justify-center gap-2"
                                        >
                                            <Icon
                                                name="tabler:cloud-upload"
                                                class="text-common text-5xl opacity-85"
                                            />
                                            <span
                                                class="text-common font-semibold opacity-85"
                                            >
                                                Upload Category Image
                                            </span>
                                        </div>
                                        <!-- Hidden Input for File Selection -->
                                        <input
                                            id="category-icon"
                                            @change="onImageSelected"
                                            type="file"
                                            hidden
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button
                                type="submit"
                                class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                            >
                                Save updated Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
