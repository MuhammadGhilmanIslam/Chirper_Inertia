<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Events\ChirpCreated;
use App\Notifications\MentionedInChirp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function parseMentions()
{
    preg_match_all('/@(\w+)/', $this->content, $matches);
    $mentionedUsernames = $matches[1];

    foreach ($mentionedUsernames as $username) {
        $user = User::where('username', $username)->first();
        if ($user) {
            // Kirimkan notifikasi atau logika lainnya
            $user->notify(new MentionedInChirp($this));
        }
    }
}
}


