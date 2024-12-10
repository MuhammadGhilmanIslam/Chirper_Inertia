<template>
  <form @submit.prevent="submitForm" enctype="multipart/form-data">
    <textarea v-model="form.content" placeholder="Write your chirp here"></textarea>
    <input type="file" @change="handleFile" accept="image/*,video/*">
    <button type="submit">Post Chirp</button>
  </form>
</template>

<script>
import { reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  setup() {
    const form = useForm({
      content: '',
      file: null,
    });

    const handleFile = (event) => {
      form.file = event.target.files[0];
    };

    const submitForm = () => {
      form.post(route('chirps.store'));
    };

    return { form, handleFile, submitForm };
  },
};
</script>