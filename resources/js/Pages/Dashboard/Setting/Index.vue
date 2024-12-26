<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Search from "@/Components/Dashboard/Search.vue";
import modal from "@/Components/Dashboard/Modal.vue";
import { ref, watch, nextTick, onMounted, defineProps } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import Quill from "quill";
import "quill/dist/quill.snow.css";

// Initialize references
const quillEditor = ref(null);
let quillInstance = null;
const isModalOpened = ref(false);

const tabs = ["App", "Header", "Home", "Footer"];
const activeTab = ref(0);

const props = defineProps({
    parentCategories: Object,
    allCategories: Object,
    settings: Object,
    footerColumns: Object,
    pages: Object,
    errors: Array,
});

const setting = useForm({
    header_categories: props.settings.header_categories || [],
    home_categories: props.settings.home_categories || [],
    course_categories: props.settings.course_categories || [],
    phone: props.settings.phone || null,
    email: props.settings.email || null,
    facebook_link: props.settings.facebook_link || null,
    instagram_link: props.settings.instagram_link || null,
    linkedin_link: props.settings.linkedin_link || null,
    youtube_link: props.settings.youtube_link || null,
    Skype_link: props.settings.Skype_link || null,
    currency_symbol: props.settings.currency_symbol || null,
    address: props.settings.address || null,
});

const onSubmit = async () => {
    try {
        router.post("/dashboard/setting", setting);
        toast.success("App Added Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
    }
};

watch(
    () => isModalOpened.value,
    async (newValue) => {
        if (newValue) {
            // Wait for the modal's DOM to be rendered
            await nextTick(() => {
                if (quillEditor.value && !quillInstance) {
                    quillInstance = new Quill(quillEditor.value, {
                        theme: "snow",
                        modules: {
                            toolbar: [
                                [
                                    { header: "1" },
                                    { header: "2" },
                                    { header: "3" },
                                ],
                                [{ list: "ordered" }, { list: "bullet" }],
                                ["bold", "italic", "underline"],
                                ["link"],
                                ["blockquote", "code-block"],
                                [{ align: [] }],
                                ["image", "video"],
                            ],
                        },
                    });

                    // Set initial content for Quill if there's any description
                    if (form.content) {
                        quillInstance.root.innerHTML = form.content;
                    }

                    quillInstance.on("text-change", () => {
                        form.content = quillInstance.root.innerHTML;
                    });
                }
            });
        }
    },
    { immediate: true }
);

// Open and close modal functions
const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

const form = useForm({
    title: null,
    pages: null,
    content: null, // Ensure you have description in your form
    order_number: null,
});

const FooterOnSubmit = async () => {
    try {
        router.post("/dashboard/footer", form);
        toast.success("Footer Added Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
    }
};

const onFooterDelete = async (footerId) => {
    try {
        await router.delete(`/dashboard/footer/${footerId}`);

        toast.success("Footer Deleted Successfully", { autoClose: 3000 });
    } catch (error) {
        toast.error("Failed to delete Footer", { autoClose: 3000 });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <section>
            <div class="p-4">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2">
                        <Icon
                            name="material-symbols:settings-outline-rounded"
                            class="text-lg"
                        />
                        <h3 class="text-base font-medium">Setting</h3>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <div class="w-1/5">
                        <ul
                            class="border border-primary/30 rounded overflow-hidden"
                        >
                            <li v-for="(tab, index) in tabs" :key="index">
                                <button
                                    @click="activeTab = index"
                                    :class="[
                                        'px-4 py-2 w-full border-b border-primary/30 hover:bg-primary hover:text-white',
                                        activeTab === index
                                            ? 'bg-primary text-white'
                                            : 'text-black',
                                    ]"
                                >
                                    {{ tab }}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="w-4/5">
                        <div
                            class="w-full border border-primary/20 rounded p-2"
                        >
                            <div
                                class="w-full flex flex-wrap"
                                v-if="activeTab === 0"
                            >
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Phone Number</label
                                    >
                                    <input
                                        v-model="setting.phone"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Email</label
                                    >
                                    <input
                                        v-model="setting.email"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Facebook</label
                                    >
                                    <input
                                        v-model="setting.facebook_link"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>

                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Instagram</label
                                    >
                                    <input
                                        v-model="setting.instagram_link"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Linked In</label
                                    >
                                    <input
                                        v-model="setting.linkedin_link"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Youtube</label
                                    >
                                    <input
                                        v-model="setting.youtube_link"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Skype</label
                                    >
                                    <input
                                        v-model="setting.Skype_link"
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                    />
                                </div>

                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Currency Symbol</label
                                    >
                                    <input
                                        type="text"
                                        class="p-2 rounded-md w-full border border-primary"
                                        v-model="setting.currency_symbol"
                                    />
                                </div>
                                <div class="w-full px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Address</label
                                    >
                                    <textarea
                                        v-model="setting.address"
                                        class="p-2 w-full focus:outline-none focus:ring-0 focus:border-common rounded ring-0 border border-common shadow-md shadow-common/50 transition-all ease-in-out duration-100 border border-primary"
                                    ></textarea>
                                </div>

                                <div class="px-2 mb-2 mt-5">
                                    <button
                                        class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                                        @click="onSubmit"
                                    >
                                        Save App Setting
                                    </button>
                                </div>
                            </div>

                            <div
                                class="w-full flex flex-wrap gap-4"
                                v-if="activeTab === 1"
                            >
                                <div class="w-full px-2">
                                    <label
                                        for="header-category"
                                        class="text-xs mb-1 block"
                                        >Header Category</label
                                    >
                                    <v-select
                                        v-if="parentCategories"
                                        label="name"
                                        :options="parentCategories"
                                        :reduce="(item) => item.id"
                                        v-model="setting.header_categories"
                                        multiple
                                    >
                                        <template v-slot:option="option">
                                            <li class="flex items-start py-1">
                                                <div
                                                    class="flex items-center justify-between w-full"
                                                >
                                                    <div
                                                        class="me-1 flex items-center gap-2"
                                                    >
                                                        <img
                                                            :src="`/storage/img/${option.image}`"
                                                            class="w-12 h-12"
                                                        />
                                                        <h6 class="mb-25">
                                                            {{ option?.name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </v-select>
                                </div>
                                <div class="px-2">
                                    <button
                                        class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                                        @click="onSubmit"
                                    >
                                        Save Header Setting
                                    </button>
                                </div>
                            </div>
                            <div
                                class="w-full flex flex-wrap gap-4"
                                v-if="activeTab === 2"
                            >
                                <div class="w-full px-2">
                                    <label
                                        for="header-category"
                                        class="text-xs mb-1 block"
                                        >Home Category</label
                                    >
                                    <v-select
                                        v-if="allCategories"
                                        label="name"
                                        :options="allCategories"
                                        :reduce="(item) => item.id"
                                        v-model="setting.home_categories"
                                        multiple
                                    >
                                        <template v-slot:option="option">
                                            <li class="flex items-start py-1">
                                                <div
                                                    class="flex items-center justify-between w-full"
                                                >
                                                    <div
                                                        class="me-1 flex items-center gap-2"
                                                    >
                                                        <img
                                                            :src="`/storage/img/${option.image}`"
                                                            class="w-12 h-12"
                                                        />
                                                        <h6 class="mb-25">
                                                            {{ option?.name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </v-select>
                                </div>

                                <div class="w-full px-2">
                                    <label
                                        for="header-category"
                                        class="text-xs mb-1 block"
                                        >Home Categories With Courses</label
                                    >
                                    <v-select
                                        v-if="allCategories"
                                        label="name"
                                        :options="allCategories"
                                        :reduce="(item) => item.id"
                                        v-model="setting.course_categories"
                                        multiple
                                    >
                                        <template v-slot:option="option">
                                            <li class="flex items-start py-1">
                                                <div
                                                    class="flex items-center justify-between w-full"
                                                >
                                                    <div
                                                        class="me-1 flex items-center gap-2"
                                                    >
                                                        <img
                                                            :src="`/storage/img/${option.image}`"
                                                            class="w-12 h-12"
                                                        />
                                                        <h6 class="mb-25">
                                                            {{ option?.name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </v-select>
                                </div>
                                <div class="px-2">
                                    <button
                                        class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary"
                                        @click="onSubmit"
                                    >
                                        Save Home Setting
                                    </button>
                                </div>
                            </div>

                            <div class="w-full" v-if="activeTab === 3">
                                <div
                                    class="flex items-center justify-between mb-2"
                                >
                                    <h3 class="text-lg font-semibold">
                                        Footer
                                    </h3>
                                    <button
                                        class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal"
                                        @click="openModal"
                                    >
                                        <Icon
                                            name="material-symbols:add-box-outline"
                                        />
                                        Add Footer
                                    </button>
                                </div>
                                <div class="relative overflow-x-auto">
                                    <table
                                        class="w-full text-sm text-left rtl:text-right"
                                    >
                                        <thead
                                            class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Column Title
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Order Number
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="column in footerColumns"
                                                class="hover:bg-primary/10"
                                            >
                                                <td class="px-6 py-4">
                                                    {{ column?.title }}
                                                </td>
                                                <th class="px-6 py-4">
                                                    {{ column?.order_number }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div
                                                        class="flex items-center gap-2"
                                                    >
                                                        <button
                                                            @click="
                                                                onFooterDelete(
                                                                    column?.id
                                                                )
                                                            "
                                                            class="text-white font-semibold hover:bg-secondary bg-rose-500 px-2 py-1 rounded-sm"
                                                        >
                                                            <Icon
                                                                name="material-symbols:delete-outline"
                                                                class="text-lg"
                                                            />
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <modal
            title="Add New Footer Column"
            :isOpen="isModalOpened"
            @modal-close="closeModal"
        >
            <div class="flex flex-col gap-2">
                <div class="w-full">
                    <label for="title" class="text-xs block mb-1"
                        >Column Title</label
                    >
                    <input
                        type="text"
                        class="p-2 rounded w-full border border-primary"
                        v-model="form.title"
                    />
                </div>
                <div class="w-full">
                    <label for="title" class="text-xs block mb-1"
                        >Column Pages</label
                    >
                    <v-select
                        label="title"
                        :options="pages"
                        :reduce="(item) => item.id"
                        multiple
                        v-model="form.pages"
                    >
                    </v-select>
                </div>
                <div class="full flex space-x-2">
                    <div class="w-1/2">
                        <label for="title" class="text-xs block mb-1"
                            >Order Number</label
                        >
                        <input
                            type="text"
                            class="p-2 rounded w-full border border-primary"
                            v-model="form.order_number"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <label for="title" class="text-xs block mb-1"
                        >Column Content</label
                    >
                    <div class="footer-content">
                        <div class="editor_data">
                            <div ref="quillEditor" class="quill-editor"></div>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-5">
                    <Button
                        @click="FooterOnSubmit"
                        class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary w-full"
                        >Save Footer Column</Button
                    >
                </div>
            </div>
        </modal>
    </AuthenticatedLayout>
</template>

<style scoped>
.quill-editor {
    height: 200px;
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
