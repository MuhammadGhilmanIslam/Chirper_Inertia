import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';

export default function CreateChirp() {
  const { data, setData, post } = useForm({
    content: '',
    file: null,
  });

  const handleFileChange = (e) => {
    setData('file', e.target.files[0]);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('chirps.store'));
  };

  return (
    <form onSubmit={handleSubmit} encType="multipart/form-data">
      <textarea
        value={data.content}
        onChange={(e) => setData('content', e.target.value)}
        placeholder="Write your chirp here"
      />
      <input type="file" onChange={handleFileChange} accept="image/*,video/*" />
      <button type="submit">Post Chirp</button>
    </form>
  );
}
