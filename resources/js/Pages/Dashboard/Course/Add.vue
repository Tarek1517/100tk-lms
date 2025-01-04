<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue3-toastify";
import { ref, onMounted, watch } from "vue";

import Quill from "quill";
import "quill/dist/quill.snow.css";

const quillEditor = ref(null);
let quillInstance = null;

// Define your form using Inertia's form helper
const form = useForm({
    title: "",
    cover_image: null,
    imagePreview: null,
    short_description: "",
    description: "",
    price: null,
    category_id: null,
});

const props = defineProps({
    allCategories: Array,
});

// Handle the image file input change
const cover_image = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.cover_image = file;
        form.imagePreview = URL.createObjectURL(file); // Create preview URL for the image
    }
};

const onSubmit = async () => {
    try {
        await form.post("/dashboard/course", form.data);
        toast.success("Course Added Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
    }
};

onMounted(() => {
    quillInstance = new Quill(quillEditor.value, {
        theme: "snow",
        modules: {
            toolbar: [
                [{ header: "1" }, { header: "2" }, { header: "3" }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["bold", "italic", "underline"],
                ["link"],
                ["blockquote", "code-block"],
                [{ align: [] }],
                ["image", "video"],
            ],
        },
    });

    // Update form.description when Quill content changes
    quillInstance.on("text-change", () => {
        form.description = quillInstance.root.innerHTML;
    });
});
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
                        <h3 class="text-lg font-medium">Add Course</h3>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <div class="shadow-lg rounded-lg p-4 max-w-3xl mx-auto">

                        <div>
                            <div class="flex items-center flex-wrap">
                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Course Title</label
                                    >
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Select Category</label
                                    >
                                    <select
                                        v-model="form.category_id"
                                        id="category"
                                        class="w-full border border-primary rounded-md focus:outline-none focus:ring-2 focus:ring-secondary"
                                    >
                                        <option value="" disabled>
                                            Select a category
                                        </option>
                                        <option
                                            v-for="category in allCategories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >price</label
                                    >
                                    <input
                                        v-model="form.price"
                                        type="number"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
                                </div>

                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Short Description</label
                                    >
                                    <textarea
                                        class="p-2 w-full focus:outline-none focus:ring-secondary rounded-md ring-0 bg-white border border-primary shadow-md shadow-common/50 transition-all ease-in-out duration-100"
                                        v-model="form.short_description"
                                    ></textarea>
                                </div>
                            </div>


                            <div
                                class="flex items-center my-10 border border-primary border-dotted p-3 rounded-md"
                            >
                                <div class="w-full">
                                    <label
                                        for="category-icon"
                                        class="text-sm block mb-2"
                                        >Cover Image</label
                                    >
                                    <label
                                        class="border border-common border-dashed p-4 rounded-2xl flex items-center justify-center w-full h-52 cursor-pointer"
                                    >
                                        <!-- Image Preview -->
                                        <img
                                            v-if="form.cover_image"
                                            :src="form.imagePreview"
                                            class="w-1/3 h-auto mb-5"
                                        />
                                        <!-- If No Image Selected -->
                                        <div
                                            v-if="!form.cover_image"
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
                                            @change="cover_image"
                                            type="file"
                                            hidden
                                        />
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <label for="description" class="text-sm block mb-2"
                                >Description</label
                            >
                            <div class="editor_data">
                                <div
                                    ref="quillEditor"
                                    class="quill-editor"
                                ></div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button
                                class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                                @click="onSubmit"
                            >
                                Save Course
                            </button>
                        </div>

                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<style scoped>
.quill-editor {
    height: 300px;
    border: 1px solid #ccc;
}

.input-field {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
}

.image-preview img {
    max-width: 50px;
    max-height: 50px;
}
</style>
