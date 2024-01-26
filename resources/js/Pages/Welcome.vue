<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
  code: {
    type: String,
  },
});

const form = useForm({
  link: '',
  remember: false,
});

const submit = () => {
  form.post(route('shortlink.store'));
};
</script>

<template>
  <GuestLayout>

    <Head title="Welcome" />

    <form @submit.prevent="submit">
      <div class="mt-4">
        <InputLabel for="link" value="Введите ссылку" />

        <TextInput id="link" type="text" class="mt-1 block w-full" v-model="form.link" required />
        <InputError class="mt-2" :message="form.errors.link" />
      </div>

      <div class="flex items-end mt-4">
        <PrimaryButton class="ml-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Отправить
        </PrimaryButton>
      </div>

      <div v-if="code" class="mt-1 mb-4 font-medium text-sm text-green-600">
        <a :href="route('shortlink.link', code)" target="_blank">{{ route('shortlink.link', code) }}</a>
      </div>
    </form>
  </GuestLayout>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
