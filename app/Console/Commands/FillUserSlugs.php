<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class FillUserSlugs extends Command
{
    protected $signature = 'fill:userslugs';
    protected $description = 'Fill the slug field for users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $slug = Str::slug($user->name);
            $originalSlug = $slug;
            $counter = 1;

            // Ensure the slug is unique
            while (User::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $user->slug = $slug;
            $user->save();
        }

        $this->info('User slugs filled successfully.');
    }
}
