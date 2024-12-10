<template>
    <div>
      <p>{{ chirp.content }}</p>
      <img v-if="chirp.file_path && chirp.file_path.endsWith('.png')" :src="chirp.file_url" alt="Chirp Image" />
      <video v-if="chirp.file_path && chirp.file_path.endsWith('.mp4')" controls>
        <source :src="chirp.file_url" type="video/mp4" />
      </video>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      chirp: Object,
    },
  };
  </script>
  