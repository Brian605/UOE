<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'procurement']);
        Role::create(['name' => 'storage']);
        Role::create(['name' => 'Crops']);
        Role::create(['name' => 'finance']);
        Role::create(['name' => 'operation']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'research']);
        Role::create(['name' => 'publication']);
        Role::create(['name' => 'administration']);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'livestock']);


        $u=User::create([
           'name'=>'Farm Admin',
           'email'=>'admin@uoefms.ac.ke',
           'password' => bcrypt('admin@uoefms$0;'),
       ]);
       $u->assignRole('Super Admin');
    }
}
