<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\Department;
use App\Models\Division;
use App\Models\Notification;
use App\Models\Position;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Profile::create([
            'address' => 'Cipayung, Depok',
            'nip' => '200103011049',
            'department_id' => 1,
            'position_id' => 1
        ]);

        User::create([
            'name' => 'Administrator 1',
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345'),
            'profile_id' => 1,
            'role' => 'admin'
        ]);



        Department::create([
            'user_id' => 1,
            'name' => 'YBM PLN Pusat'
        ]);

        Position::create([
            'name' => 'Deputi Direktur'
        ]);

        Position::create([
            'name' => 'Manajer'
        ]);

        Position::create([
            'name' => 'Staff'
        ]);

        Position::create([
            'name' => 'Asmen'
        ]);

        ActivityType::create([
            'type' => 'Rapat'
        ]);

        ActivityType::create([
            'type' => 'Dinas'
        ]);

        ActivityType::create([
            'type' => 'Cuti'
        ]);

        ActivityType::create([
            'type' => 'Sakit'
        ]);

        ActivityType::create([
            'type' => 'Izin'
        ]);

        ActivityType::create([
            'type' => 'Libur'
        ]);

        Notification::create([
            'message' => 'Menambahkan aktivitas baru',
            'activity_id' => 2,
            'isRead' => '0'
        ]);

        Department::factory(5)->create();
        User::factory(10)->create();
        Profile::factory(10)->create();
        Activity::factory(11)->create();
    }
}
