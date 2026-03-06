<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          


        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        $createUser = Permission::firstOrCreate(['name' => 'create_user']);
        $editUser = Permission::firstOrCreate(['name' => 'edit_user']);
        $deleteUser = Permission::firstOrCreate(['name' => 'delete_user']);

        $adminRole->givePermission($createUser);
        $adminRole->givePermission($editUser);
        $adminRole->givePermission($deleteUser);

        $user = User::first();

        if($user){
            $user->assignRole($adminRole);
        }

        $user = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'test@.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
            'is_blocked' => false

        ]); 
        
    }
}
