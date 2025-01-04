<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue3-toastify";

// Define your form using Inertia's form helper
const form = useForm({
    name: "",
    parent_id: null,
    image: null,
    imagePreview: null,
    order_number: null,
    subtitle: "",
});

const props = defineProps({
    parentCategories: Array,
});

// Handle the image file input change
const image = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        form.imagePreview = URL.createObjectURL(file); // Create preview URL for the image
    }
};

const onSubmit = async () => {
    try {
        await form.post("/dashboard/category", form.data),
        toast.success("Category Added Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <section class="bg-white text-gray-800">
            <div class="p-4">
                <div
                    class="flex flex-col items-center justify-center text-xs text-white bg-secondary dark:bg-gray-700 dark:text-gray-400 mb-5 p-3 text-center rounded-md font-semibold"
                >
                    <div class="flex items-center gap-3">
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            class="text-lg"
                        />
                        <h3 class="text-lg font-medium">Add Category</h3>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <div class="shadow-lg rounded-lg p-4 max-w-3xl mx-auto">

                        <div>
                            <div class="flex items-center flex-wrap">
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

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Select Parent Category</label
                                    >
                                    <select
                                        v-model="form.parent_id"
                                        id="category"
                                        class="w-full border border-primary rounded-md focus:outline-none focus:ring-2 focus:ring-secondary"
                                    >
                                        <option value="" disabled>
                                            Select a category
                                        </option>
                                        <option
                                            v-for="category in parentCategories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Category Subtitle</label
                                    >
                                    <input
                                        v-model="form.subtitle"
                                        type="text"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Order Number</label
                                    >
                                    <input
                                        v-model="form.order_number"
                                        type="number"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>
                            </div>
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
                                            v-if="form.image"
                                            :src="form.imagePreview"
                                            class="w-1/3 h-auto mb-5"
                                        />
                                        <!-- If No Image Selected -->
                                        <div
                                            v-if="!form.image"
                                            class="flex flex-col items-center justify-center gap-2"
                                        >
                                            <Icon
                                                name="tabler:cloud-upload"
                                                class="text-common text-5xl opacity-85"
                                            />
                                            <span
                                                class="text-common font-semibold opacity-85"
                                                >Upload Category Image</span
                                            >
                                        </div>
                                        <!-- Hidden Input for File Selection -->
                                        <input
                                            id="category-icon"
                                            @change="image"
                                            type="file"
                                            hidden
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button
                                class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                                @click="onSubmit"
                            >
                                Save Category
                            </button>
                        </div>

                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
