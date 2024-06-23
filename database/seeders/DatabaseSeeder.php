<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Supprimer les utilisateurs existants
        DB::table('users')->truncate();
        DB::table('follows')->truncate(); // Tronquer également la table `follows`

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Créer un utilisateur administrateur
        $admin = User::create([
            'name' => 'Alec Thompson',
            'email' => 'admin@corporateui.com',
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => bcrypt('password'), // Mot de passe fixe pour l'admin
            'current_team_id' => null,
            'about' => 'Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no...',
            'first_name' => 'Alec',
            'birth_date' => '1985-01-01',
            'address' => '123 Main Street',
            'zip_code' => '12345',
            'city' => 'New York',
            'phone' => '1234567890',
            'activity_type' => 'loisir',
        ]);

        $admin->updateProfilePhoto($this->getRandomPhoto());

        // Utiliser Faker pour générer des utilisateurs fictifs
        $faker = Faker::create();

        $socialPlatforms = [
            'https://linkedin.com/in/',
            'https://github.com/',
            'https://slack.com/',
            'https://instagram.com/',
            'https://facebook.com/',
            'https://twitter.com/',
            'https://youtube.com/',
            'https://snapchat.com/add/',
            'https://tiktok.com/@',
            'https://telegram.me/'
        ];

        foreach (range(1, 50) as $index) {
            // Sélectionner aléatoirement des réseaux sociaux
            $selectedPlatforms = $faker->randomElements($socialPlatforms, $faker->numberBetween(0, count($socialPlatforms)));
            $socialLinks = [];

            foreach ($selectedPlatforms as $platform) {
                $socialLinks[] = $platform . $faker->userName;
            }

            $user = User::create([
                'name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'is_admin' => false,
                'password' => bcrypt('password'), // Mot de passe fixe pour les utilisateurs Faker
                'current_team_id' => null,
                'about' => $faker->sentence,
                'first_name' => $faker->firstName,
                'birth_date' => $faker->date(),
                'address' => $faker->address,
                'zip_code' => $faker->postcode,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'activity_type' => $faker->randomElement(['loisir', 'competition']),
                'social_links' => implode(',', $socialLinks),
            ]);

            $user->updateProfilePhoto($this->getRandomPhoto());
        }
    }

    /**
     * Télécharge une photo aléatoire et la retourne.
     *
     * @return \Illuminate\Http\UploadedFile
     */
    private function getRandomPhoto()
    {
        $url = 'https://picsum.photos/200';
        $photoContent = file_get_contents($url);
        $photoName = Str::random(10) . '.jpg';
        $photoPath = sys_get_temp_dir() . '/' . $photoName;

        file_put_contents($photoPath, $photoContent);

        return new UploadedFile($photoPath, $photoName, 'image/jpeg', null, true);
    }
}
