<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamLeaderDetail;
use App\Models\TeamMemberDetail;

class TeamDetailsSeeder extends Seeder
{
    // database/seeders/TeamDetailsSeeder.php
public function run()
{
    // Team Leader
    TeamLeaderDetail::create([
        'name' => 'Dr Jean-Baptiste GUIARD-SCHMID',
        'position' => 'Directeur Général',
        'image' => 'img/12.jpg',
        'description' => 'Spécialiste en médecine interne, maladies infectieuses et tropicales et santé publique...'
    ]);

    // Team Members
    TeamMemberDetail::create([
        'name' => 'DR JEAN-BAPTISTE GUIARD-SCHMID',
        'position' => 'Directeur Général',
        'image' => 'img/12.jpg',
        'link' => 'team-details.html'
    ]);

    TeamMemberDetail::create([
        'name' => 'DR BENOIT KAFANDO',
        'position' => 'Directeur des Programmes',
        'image' => 'img/13.jpg',
        'link' => 'team-details.html'
    ]);

    TeamMemberDetail::create([
        'name' => 'MARTIAL SIDWAYAN ZONGO',
        'position' => 'Directeur Administratif et Financier',
        'image' => 'img/14.jpg',
        'link' => 'team-details.html'
    ]);
}
}
