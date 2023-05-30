<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Hash;

use App\Models\User;
use Spatie\Permission\Models\Role;

class AdmininfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'BISU',
            'middle_name' => '',
            'last_name' => 'Bilar',
            'email' => 'bisualumni3@gmail.com',
            'password' => Hash::make('aug151973'),
            'address' => 'Bilar',
            // 'address' => 'Bilar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Find the role by name and assign it to the user
        $role = Role::where('name', 'Admin')->first();
        $user->assignRole($role);
    }
}
