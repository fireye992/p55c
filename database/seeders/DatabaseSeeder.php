<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\CarouselSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Supprimer l'utilisateur existant s'il existe
        DB::table('users')->where('email', 'admin@corporateui.com')->delete();

        // Créer un nouvel utilisateur
        User::create([
            'name' => 'Alec Thompson',
            'email' => 'admin@corporateui.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // change this to a proper hashed password
            'profile_photo_path' => null,
            'current_team_id' => null,
            'about' => 'Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no...',
        ]);

          // Appeler le seeder pour le carrousel
          $this->call(CarouselSeeder::class);
    }
}
