<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CourseCard2 from "@/Components/CourseCard2.vue";
import Container from "@/Components/Container.vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { toast } from "vue3-toastify";

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

// Safely access page props
const { props: pageProps } = usePage();
const user = computed(() => pageProps.auth?.validStudent || null);

// Initialize the form
const form = useForm({
    course_id: props.showCourse?.id || null,
    student_id: user.value?.id || null,
    totals_amount: props.showCourse?.price || 0,
    payment_method: "SSL_Commerz",
});

const addPayment = async () => {
    try {
        await form.post("/save_order", {
            forceFormData: true,
            preserveScroll: true,
        });
        toast.success("Order Added Successfully");
    } catch (error) {
        console.error("Error occurred:", error);
        toast.error("Failed to add order. Please try again.");
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
                    {{ errors }}

                    <ul class="space-y-4 text-gray-600">
                        <li>
                            <strong class="font-medium">Credit Card</strong>
                        </li>
                        <li><strong class="font-medium">PayPal</strong></li>
                        <li>
                            <strong class="font-medium">Bank Transfer</strong>
                        </li>
                        <form @submit="addPayment">
                            <button type="submit">Pay Now</button>
                        </form>
                    </ul>
                </div>
            </div>
        </Container>
    </AppLayout>
</template>

<style scoped></style>
