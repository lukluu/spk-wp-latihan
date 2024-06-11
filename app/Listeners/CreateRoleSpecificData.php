<?php

namespace App\Listeners;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateRoleSpecificData
{
    /**
     * Create the event listener.
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        if ($user->role == 'mahasiswa') {
            Mahasiswa::create([
                'user_id' => $user->id,
            ]);
        }

        if ($user->role == 'dosen') {
            Dosen::create([
                'user_id' => $user->id,
            ]);
        }
    }
}
