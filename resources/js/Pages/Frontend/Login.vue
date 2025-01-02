<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { toast } from "vue3-toastify";


const props = defineProps({
    home_categories: Array,
    course_categories: Array,
    settings: Object,
    errors: Array,

});

const form = useForm({
  email: '',
  password: '',
});

const onSubmit = async () => {
  try {
    await form.post('/student/login/store', {
      onSuccess: () => {
        toast.success('Student Logged in Successfully');
      },
      onError: (error) => {
        console.error('Error occurred:', error);
        toast.error('Failed to log in');
      },
    });
  } catch (error) {
    console.error('Error occurred:', error);
    toast.error('An unexpected error occurred');
  }
};

</script>

<template>
    <AppLayout :settings="settings">
        <div class="w-full flex justify-center items-center py-10 lg:py-20">
            <div
                class="w-[90%] max-w-4xl bg-white flex flex-wrap rounded-xl shadow-xl p-4 pb-10"
            >
                <div class="w-full lg:w-1/2 lg:pr-5 lg:pt-10">
                    <Link href="/login" class="text-2xl font-semibold mb-3"
                        >Login</Link
                    >
                    <form @submit.prevent="onSubmit">
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
                                Log In
                            </button>
                        </div>
                    </form>


                    <p>
                        Don't have an account
                        <Link href="/Student/Register" class="text-primary"
                            >Create Account</Link
                        >.
                    </p>
                </div>
                <div class="hidden lg:block w-1/2">
                    <img
                        class="w-full h-96 object-cover rounded-xl"
                        src="@/assets/images/login.jpg"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
