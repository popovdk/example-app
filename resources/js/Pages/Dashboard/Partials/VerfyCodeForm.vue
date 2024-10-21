<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const form = useForm({
    code: '',
});

const verifyCodeInput = ref();

function verifyCode () {
    form.put(route('profile.verify'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.code) {
                form.reset('code');
                verifyCodeInput.value.focus();
            }
        },
    });
}
</script>

<template>
    <div
        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
    >
        <div class="p-6 text-gray-900">
            You must confirm your account on the Telagram channel.
            <br />
            Please enter the confirmation code of the corresponding email in the Telagram channel
            <a target="_blank" class="underline" href="https://t.me/+6x0ZPuiuAGoyZWUy"> https://t.me/+6x0ZPuiuAGoyZWUy </a>


            <form @submit.prevent="verifyCode" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="verify_code" value="Verify code" />

                    <TextInput
                        id="verify_code"
                        ref="verifyCodeInput"
                        v-model="form.code"
                        class="mt-1 block w-full"
                    />

                    <InputError
                        :message="form.errors.code"
                        class="mt-2"
                    />
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
