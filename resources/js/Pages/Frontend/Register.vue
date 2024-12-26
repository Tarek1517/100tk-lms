<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue3-toastify";
import { ref, onMounted, watch } from "vue";

const props = defineProps({
    home_categories: Array,
    course_categories: Array,
    settings: Object,
    errors: Array,

});

const form = useForm({
    name: "",
    email: null,
    mobile: null,
    password: null,
});

const onSubmit = async () => {
    try {
        await form.post("/Student/store", form.data);
        toast.success("Student Register Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
    }
};
</script>

<template>
    <AppLayout :settings="settings">
        <div class="w-full flex justify-center items-center py-10 lg:py-20">
            <div
                class="w-[90%] max-w-2xl bg-white flex flex-wrap rounded-xl shadow-xl"
            >
                <div class="w-full p-5">
                    <div class="mb-5 text-center">
                        <Link href="/login" class="text-2xl font-semibold mb-3"
                            >Register</Link
                        >
                    </div>


                    <form @submit="onSubmit">
                        <div class="">
                            <label for="name" class="block pb-1 text-xs"
                                >Name</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                                v-model="form.name"
                            />
                        </div>

                        <div class="">
                            <label for="email" class="block pb-1 text-xs"
                                >Email</label
                            >
                            <input
                                v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>

                        <div class="">
                            <label for="phone" class="block pb-1 text-xs"
                                >Phone</label
                            >
                            <input
                                v-model="form.mobile"
                                type="string"
                                name="mobile"
                                id="phone"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>
                        

                        <div class="">
                            <label for="password" class="block pb-1 text-xs"
                                >Password</label
                            >
                            <input
                                v-model="form.password"
                                type="password"
                                name="password"
                                id="password"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>

                        <div class="text-center py-5">
                            <button
                                class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2"
                            >
                                Register
                            </button>
                        </div>
                    </form>
                    <p class="mb-5 text-center">
                        Do you have an account?
                        <Link href="/Student/Login" class="text-primary"
                            >Login</Link
                        >
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
