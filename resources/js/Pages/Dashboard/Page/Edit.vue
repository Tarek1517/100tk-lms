<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue3-toastify";
import { ref, onMounted, watch, nextTick } from "vue";

import Quill from "quill";
import "quill/dist/quill.snow.css";

const quillEditor = ref(null);
let quillInstance = null;

const props = defineProps({
    editPage: Object,
});

// Define your form using Inertia's form helper
const form = useForm({
    _method: "put",
    title: props.editPage.title || "",
    content: props.editPage.content || "",
});

const onUpdate = () => {
    form.post(`/dashboard/page/${props?.editPage?.id}`, {
        forceFormData: true,
        preserveScroll: true,
    });
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

    nextTick(() => {
        if (form.content) {
            quillInstance.root.innerHTML = form.content;
        }
    });

    quillInstance.on("text-change", () => {
        form.content = quillInstance.root.innerHTML;
    });
});

watch(
    () => form.content,
    (newDescription) => {
        if (newDescription && quillInstance) {
            quillInstance.root.innerHTML = newDescription;
        }
    }
);
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
                        <h3 class="text-lg font-medium">Update Course</h3>
                    </div>
                </div>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <div class="shadow-lg rounded-lg p-4 max-w-3xl mx-auto">
                    <form @submit="onUpdate">
                        <div>
                            <div class="flex items-center flex-wrap">
                                <div class="w-full">
                                    <label for="name" class="text-sm block mb-2"
                                        >Page Title</label
                                    >
                                    <input
                                        v-model="form.title"
                                        type="text"
                                        class="border border-primary rounded-md font-normal text-sm w-full"
                                    />
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
                                type="submit"
                            >
                                update Page
                            </button>
                        </div>
                    </form>
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
