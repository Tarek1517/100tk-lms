<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CourseCard2 from "@/Components/CourseCard2.vue";
import Container from "@/Components/Container.vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
import { toast } from "vue3-toastify";
import axios from "axios";

const props = defineProps({
    settings: {
        type: Object,
        required: true,
    },
    auth: {
        type: Object,
        required: false,
    },
    showCourse: {
        type: Object,
        required: true,
    },
    errors: Array,
});

const showLoginModal = ref(false);

// Safely access page props
const { props: pageProps } = usePage();
const user = computed(() => pageProps.auth?.validStudent || null);

// Initialize the form
const form = useForm({
    email: null,
    password: null,
    course_id: props.showCourse?.id || null,
    student_id: user.value?.id || null,
    totals_amount: props.showCourse?.price || 0,
    payment_method: "SSL_Commerz",
});

const addPayment = async () => form.post("/save_order");

const order = async () => {
    try {
        const res = await axios.post("/save_order", form);

        toast.success("Order placed successfully!", {
            position: "top-center",
            autoClose: 3000, // Auto close after 3 seconds
        });

        // Redirect to the response URL
        window.location.replace(res.data?.data);
    } catch (error) {
        console.error("Error submitting the order:", error);

        // If there's an error, show an error toast
        toast.error("Failed to place the order. Please try again.", {
            position: "top-center",
            autoClose: 3000,
        });
    }
};

const handleLogin = async (form) => {
    try {
        await form.post("/login/store", {
            onSuccess: (response) => {
                // Check if login was successful based on the response
                if (response.success) {
                    toast.success("Student logged in successfully!", {
                        autoClose: 1000,
                    });
                    showLoginModal.value = false; // Close the modal on successful login
                } else {
                    toast.error(
                        response.message || "Login failed. Please try again.",
                        { autoClose: 3000 }
                    );
                }
            },
            onError: (error) => {
                console.error("Error occurred:", error);
                toast.error(
                    "Failed to log in. Please check your credentials.",
                    { autoClose: 3000 }
                );
            },
        });
    } catch (error) {
        console.error("Unexpected error occurred:", error);
        toast.error("An unexpected error occurred. Please try again later.", {
            autoClose: 3000,
        });
    }
};
</script>

<template>
    <AppLayout :settings="settings" :auth="auth">
        <Container class="mb-10 pb-11 pt-5">
            <div class="flex space-x-8 p-8 border-b border-primary/10">
                <h2 class="font-bold text-2xl">কমপ্লিট পেমেন্ট</h2>
            </div>
            <div class="flex space-x-8 p-8">
                <div class="w-1/2 bg-white">
                    <div class="p-6 shadow-md rounded-lg border border-primary">
                        <h2 class="text-2xl font-semibold mb-4 text-primary">
                            কোর্সের বিবরণ
                        </h2>
                        <ul class="space-y-4 text-gray-600">
                            <li class="flex items-center space-x-4">
                                <img
                                    class="w-1/4 h-auto object-cover rounded-md"
                                    :src="`/storage/img/${showCourse.cover_image}`"
                                    :alt="showCourse.title"
                                />
                                <span class="text-xl font-bold">{{
                                    showCourse.title
                                }}</span>
                            </li>

                            <li>
                                <strong class="font-bold text-base text-black"
                                    >পেমেন্ট ডিটেইলস</strong
                                >
                            </li>
                            <li
                                class="flex justify-between items-center border-b border-primary/10 pb-5"
                            >
                                <strong class="font-medium"
                                    >কোর্সের মূল্য</strong
                                >
                                <span class="text-gray-500"
                                    >{{ settings.currency_symbol
                                    }}{{ showCourse.price }}</span
                                >
                            </li>

                            <li class="flex justify-between items-center">
                                <strong class="text-base font-bold text-black"
                                    >টোটাল পেমেন্ট:</strong
                                >
                                <span class="text-xl font-bold text-primary"
                                    >{{ settings.currency_symbol
                                    }}{{ showCourse.price }}</span
                                >
                            </li>
                        </ul>
                    </div>
                    <!-- icon box -->
                    <div class="flex items-center mt-11">
                        <div
                            class="flex items-center space-x-2 bg-primary/10 text-white p-2 rounded-full"
                        >
                            <Icon
                                name="material-symbols:phone-forwarded"
                                class="text-xl text-primary"
                            />
                        </div>
                        <span class="text-base font-medium ml-2">প্রয়োজনে</span>
                        <span class="font-bold text-base"
                            ><span class="ml-1 text-primary"
                                >কল করুন {{ settings.phone }}
                            </span>
                            (সকাল ১০টা থেকে রাত ১০টা)</span
                        >
                    </div>
                </div>

                <!-- Payment Methods Column -->
                <div
                    class="w-1/2 p-6 bg-white shadow-md rounded-lg border border-primary"
                >
                    <h2 class="text-2xl font-semibold mb-4 text-primary">
                        পেমেন্টের মাধ্যম
                    </h2>

                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-center space-x-4">
                            <!-- Checkbox -->
                            <input
                                type="checkbox"
                                checked
                                disabled
                                class="w-4 h-4 text-primary border-gray-300 rounded-full focus:ring-primary"
                            />

                            <!-- Image -->
                            <img
                                class="w-auto h-16"
                                src="@/assets/images/ssl.png"
                                alt="SSL Logo"
                            />
                        </li>

                        <li class="flex justify-between items-center">
                            <strong class="text-sm font-bold text-gray-500"
                                >টোটাল পেমেন্ট:</strong
                            >
                            <span class="text-base font-bold text-primary"
                                >{{ settings.currency_symbol
                                }}{{ showCourse.price }}</span
                            >
                        </li>

                        <div class="">
                            <button
                                v-if="user && user.id"
                                @click="order"
                                type="submit"
                                class="flex items-center justify-center text-white gap-2 bg-primary hover:bg-secondary w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500"
                            >
                                Pay Now
                            </button>

                            <button
                                v-else
                                @click="showLoginModal = true"
                                type="submit"
                                class="flex items-center justify-center text-white gap-2 bg-primary hover:bg-secondary w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500"
                            >
                                Pay Now
                            </button>

                            <div
                                class="flex items-center justify-center space-x-2"
                            >
                                <!-- Icon -->
                                <Icon
                                    name="ep:lock"
                                    class="text-base text-primary"
                                />
                                <!-- Text -->
                                <span class="text-sm">সিকিউরড পেমেন্ট</span>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </Container>
        <div
            v-if="showLoginModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        >
            <div class="bg-white p-6 rounded-lg w-96 relative">
                <!-- Close Button -->
                <button
                    @click="showLoginModal = false"
                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-800"
                >
                    &times;
                </button>

                <h3
                    class="text-2xl font-semibold mb-3 text-center text-primary"
                >
                    Login
                </h3>
                <form @submit.prevent="handleLogin(form)">
                    <div class="mb-3">
                        <label for="email" class="block pb-1 text-xs"
                            >Email</label
                        >
                        <input
                            type="email"
                            id="email"
                            v-model="form.email"
                            class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block pb-1 text-xs"
                            >Password</label
                        >
                        <input
                            type="password"
                            id="password"
                            v-model="form.password"
                            class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            required
                        />
                    </div>
                    <div class="text-center py-3">
                        <button
                            type="submit"
                            class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2"
                        >
                            Log In
                        </button>
                    </div>
                    <p class="text-center">
                        Don't have an account
                        <Link href="/student/register" class="text-primary"
                            >Create Account</Link
                        >.
                    </p>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
