<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import modal from "@/Components/Dashboard/Modal.vue";
import { toast } from "vue3-toastify";
import { Inertia } from "@inertiajs/inertia";
import { useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    showCourse: Object,
    errors: Array,
});

const form = useForm({
    id: null,
    name: "",
    video_url: "",
    is_active: null,
    course_id: props.showCourse.id,
});


const isModalOpened = ref(false);
const isAddModalOpened = ref(false);

const openModal = () => {
    isModalOpened.value = true;
};

const closeModal = () => {
    isModalOpened.value = false;
    isAddModalOpened.value = false;
    form.value.name = null;
    form.value.video_url = null;
};

const isEditModalOpened = ref(false);
const editClass = ref(null);

const openEditModal = (courseClass) => {

    if (courseClass) {
        form.id = courseClass.id || null;
        form.name = courseClass.name || "";
        form.video_url = courseClass.video_url.video_url || "";
        form.is_active =
            courseClass.is_active !== null ? courseClass.is_active : null;

        editClass.value = courseClass;
        isEditModalOpened.value = true;
    } else {
        console.error("Invalid course class data:", courseClass);
    }
};

const closeEditModal = () => {
    isEditModalOpened.value = false;
    form.reset(); // Reset the form to its initial state
};

const isVideoModalOpened = ref(false);
const selectedVideoUrl = ref(null);

const openVideoModal = (videoUrl) => {
    selectedVideoUrl.value = videoUrl;
    isVideoModalOpened.value = true;
};

const closeVideoModal = () => {
    isVideoModalOpened.value = false;
    selectedVideoUrl.value = null;
};

const ClassSubmit = () => {
    try {
        router.post("/dashboard/course_classes", form);
        toast.success("Course class Added Successfully");
    } catch (error) {
        toast.error("Error occurred:", error);
    }
};

const getVimeoEmbedUrl = (url) => {
    if (typeof url !== "string") {
        console.error("Invalid URL:", url);
        return "";
    }
    const match = url.match(/vimeo\.com\/(\d+)/);
    return match ? `https://player.vimeo.com/video/${match[1]}` : "";
};

const updateClass = () => {
    form.put(`/dashboard/course_classes/${form.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Class updated successfully!");
            closeEditModal();
        },
        onError: (errors) => {
            console.error("Error updating class:", errors);
            toast.error("Error updating class.");
        },
    });
};

const deleteClass = async (classId) => {
    try {
        await Inertia.delete(`/dashboard/course_classes/${classId}`);
        toast.success("Class Deleted Successfully", { autoClose: 3000 });
    } catch (error) {
        toast.error("Failed to delete Course", { autoClose: 3000 });
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
                        <h3 class="text-lg font-medium">
                            {{ showCourse.title }} Course Details and Classes
                        </h3>
                    </div>
                    <div>
                        <button
                            class="hover:border-gray-400 dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-4 py-2 flex items-center gap-2 text-sm font-normal"
                            @click="openModal"
                        >
                            <Icon name="material-symbols:add-box-outline" />
                            Add Class
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-5 p-5">
                <div class="w-full lg:w-1/3">
                    <div
                        class="rounded-md shadow-md hover:shadow-lg dark:bg-gray-800 border"
                    >
                        <!-- Course Image -->
                        <img
                            :src="
                                showCourse.cover_image
                                    ? `/storage/img/${showCourse.cover_image}`
                                    : '/images/default.png'
                            "
                            alt="Course Image"
                            class="w-full h-48 object-cover rounded-t-lg"
                        />

                        <!-- Card Content -->
                        <div class="p-4">
                            <!-- Course Title -->
                            <h3
                                class="text-lg font-bold text-black dark:text-white"
                            >
                                {{ showCourse.title }}
                            </h3>

                            <!-- Price -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Price: </span>
                                <span class="text-base font-extrabold">৳</span>
                                <span class="text-black">{{
                                    showCourse.price
                                }}</span>
                            </p>

                            <!-- Category -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Category:</span>
                                {{ showCourse.category?.name }}
                            </p>

                            <!-- Description -->
                            <p
                                class="text-sm text-gray-700 dark:text-gray-300 mt-2"
                            >
                                <span class="font-medium">Description:</span>
                                {{ showCourse.short_description }}
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Right Side: Table -->
                <div
                    class="relative overflow-x-auto shadow-md sm:rounded-lg w-full lg:w-2/3"
                >
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-white uppercase bg-secondary dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Class Name
                                </th>
                                <th scope="col" class="py-3">Class Video</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="classItem in showCourse.course_class"
                                :key="classItem.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 hover:shadow-lg transition-all ease-in-out duration-300 dark:hover:bg-gray-600"
                            >
                                <!-- Class Name -->
                                <td class="px-6 py-4">{{ classItem.name }}</td>

                                <!-- View Video Button -->
                                <td>
                                    <button
                                        class="dark:hover:text-gray-300 bg-secondary border border-gray-300/30 text-gray-300 px-1 py-1 flex items-center rounded-full gap-2 font-normal hover:bg-primary"
                                        @click="
                                            openVideoModal(
                                                classItem.video_url.video_url
                                            )
                                        "
                                    >
                                        <Icon
                                            name="ep:video-play"
                                            class="text-2xl"
                                        />
                                    </button>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            :class="{
                                                'h-2.5 w-2.5 rounded-full me-2': true,
                                                'bg-green-500':
                                                    classItem.is_active ===
                                                    'true',
                                                'bg-red-500':
                                                    classItem.is_active !==
                                                    'true',
                                            }"
                                        ></div>
                                        <span>
                                            {{
                                                classItem.is_active === "true"
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button
                                            @click="openEditModal(classItem)"
                                            class="text-white font-semibold hover:bg-secondary bg-primary px-2 py-1 rounded-sm"
                                        >
                                            <Icon
                                                name="material-symbols:edit-square-outline"
                                                class="text-lg"
                                            />
                                        </button>
                                        <button
                                            @click.prevent="
                                                deleteClass(classItem.id)
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
        </section>
        <modal
            title="Add New Class"
            :isOpen="isModalOpened"
            @modal-close="closeModal"
        >
            <div>
                <div class="flex flex-col gap-3 pt-5">
                    <div class="w-full">
                        <label for="name" class="block text-sm mb-1"
                            >Class Name</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            class="p-2 border border-primary rounded-md w-full"
                        />
                    </div>

                    <div class="w-full">
                        <label for="name" class="block text-sm mb-1"
                            >Video URL</label
                        >
                        <input
                            v-model="form.video_url"
                            type="text"
                            class="p-2 border border-primary rounded-md w-full"
                        />
                    </div>

                    <div class="w-full">
                        <label for="status" class="block text-sm mb-1"
                            >Select Status</label
                        >

                        <div class="flex flex-col">
                            <label>
                                <input
                                    type="radio"
                                    id="true"
                                    value="true"
                                    v-model="form.is_active"
                                    name="is_active"
                                />
                                Active Class
                            </label>

                            <label>
                                <input
                                    type="radio"
                                    id="false"
                                    value="false"
                                    v-model="form.is_active"
                                    name="is_active"
                                />
                                inActive Class
                            </label>
                        </div>
                    </div>

                    <div>
                        <button
                            class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary w-full flex justify-center mb-3"
                            @click="ClassSubmit"
                        >
                            Save Class
                        </button>
                    </div>
                </div>
            </div>
        </modal>
        <modal
            title="Add New Class"
            :isOpen="isEditModalOpened"
            @modal-close="closeEditModal"
        >
            <div>
                <div class="flex flex-col gap-3 pt-5">
                    <div class="w-full">
                        <label for="name" class="block text-sm mb-1"
                            >Class Name</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            class="p-2 border border-primary rounded-md w-full"
                        />
                    </div>


                    <div class="w-full">
                        <label for="name" class="block text-sm mb-1"
                            >Video URL</label
                        >
                        <input
                            v-model="form.video_url"
                            type="text"
                            class="p-2 border border-primary rounded-md w-full"
                        />
                    </div>
                    <div class="w-full">
                        <label for="status" class="block text-sm mb-1"
                            >Select Status</label
                        >

                        <div class="flex flex-col">
                            <label>
                                <input
                                    type="radio"
                                    id="true"
                                    value="true"
                                    v-model="form.is_active"
                                    name="is_active"
                                />
                                Active Class
                            </label>

                            <label>
                                <input
                                    type="radio"
                                    id="false"
                                    value="false"
                                    v-model="form.is_active"
                                    name="is_active"
                                />
                                inActive Class
                            </label>
                        </div>
                    </div>

                    <div>
                        <button
                            class="bg-secondary py-2 px-10 text-white rounded-md hover:bg-primary w-full flex justify-center mb-3"
                            @click="updateClass"
                        >
                            Save Class
                        </button>
                    </div>
                </div>
            </div>
        </modal>

        <modal :isOpen="isVideoModalOpened" @modal-close="closeVideoModal">
            <div>
                <div class="flex flex-col pt-3">
                    <div class="w-full">
                        <iframe
                            v-if="selectedVideoUrl"
                            :src="getVimeoEmbedUrl(selectedVideoUrl)"
                            width="550"
                            height="300"
                            frameborder="0"
                            allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen
                        ></iframe>
                        <p v-else class="text-sm text-gray-500">
                            No video available
                        </p>
                    </div>
                </div>
            </div>
        </modal>
    </AuthenticatedLayout>
</template>
