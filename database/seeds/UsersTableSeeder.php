<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Jesus Lozano',
            'email' => 'jesus.lozano@naranya.com',
        ]);
        factory(User::class, 30)->create();
    }
}
