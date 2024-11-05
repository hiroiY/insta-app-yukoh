<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function run(): void
    {
        // $this->user->factory(10)->create([
        //     'name' = Str::random(5),
        //     'email' = Str::random(5).'@email.com',
        //     'password' = Hash::make('password'),
        //     'created_at' = now(),
        //     'updated_at' = now()
        // ]);
        
        // $this->user->save();
        
        // $this->user->name = Str::random(5);
        // $this->user->email = Str::random(5).'@email.com';
        // $this->user->password = Hash::make('password');
        // $this->user->created_at = now();
        // $this->user->updated_at = now();
    }
}
