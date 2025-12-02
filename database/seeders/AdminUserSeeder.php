<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'utilisateur admin existe déjà
        $existingUser = User::where('email', 'admin@keneya.com')->first();

        if (!$existingUser) {
            // Créer un utilisateur admin
            User::create([
                'name' => 'Admin Keneya',
                'email' => 'admin@keneya.com',
                'password' => Hash::make('password123'), // À changer en production
                'email_verified_at' => now(),
            ]);

            echo "✅ Utilisateur admin créé avec succès!\n";
            echo "Email: admin@keneya.com\n";
            echo "Mot de passe: password123\n";
        } else {
            echo "ℹ️ Utilisateur admin existe déjà (admin@keneya.com)\n";
        }
    }
}
