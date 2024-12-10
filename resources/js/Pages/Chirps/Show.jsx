import React from 'react';

export default function ShowChirp({ chirp }) {
  return (
    <div>
      <p>{chirp.content}</p>
      {chirp.file_path && chirp.file_path.endsWith('.png') && (
        <img src={chirp.file_url} alt="Chirp Image" />
      )}
      {chirp.file_path && chirp.file_path.endsWith('.mp4') && (
        <video controls>
          <source src={chirp.file_url} type="video/mp4" />
        </video>
      )}
    </div>
  );
}
