<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Antis;  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::count() < 3 
                    ? collect([
                        user::create([
                            'name' => 'teste',
                            'email' => 'teste@testge',
                            'password'=> bcrypt('password'),
                        ]),
                              user::create([
                            'name' => 'dasdsads',
                            'email' => 'tdasdsad@dsasdad',
                            'password'=> bcrypt('password'),
                        ]),
                              user::create([
                            'name' => 'asdadsadsad',
                            'email' => 'tassdarew@fafsae',
                            'password'=> bcrypt('password'),
                        ])
                    ]) : User::take(3)->get();
        $antis =  [

            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with Chirper today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'Deployed my first app with Laravel Cloud. So smooth!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        foreach ($antis as $message){
                $users->random()->antis()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }}
}
