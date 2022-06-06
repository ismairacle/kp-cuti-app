<?php

namespace Database\Seeders;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'approver']);


        User::create([
            'name' => 'karyawan1',
            'email' => 'karyawan1@email.com',
            'jenis_kelamin' => 'Laki-Laki',
            'divisi' => 'Customer Service',
            'jabatan' => 'Karyawan',
            'kontak' => '089998988767',
            'id_karyawan' => 'GYD-1232321',
            'password' => Hash::make('karyawan1234')
        ])->assignRole('user');

        User::create([
            'name' => 'karyawan2',
            'email' => 'karyawan2@email.com',
            'jenis_kelamin' => 'Perempuan',
            'divisi' => 'Customer Service',
            'jabatan' => 'Karyawan',
            'kontak' => '089998988767',
            'id_karyawan' => 'GYD-1232321',
            'password' => Hash::make('karyawan1234')
        ])->assignRole('user');


        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'divisi' => 'Divisi',
            'jabatan' => 'Jabatan',
            'kontak' => '08999898988',
            'password' => Hash::make('admin1234')
        ])->assignRole('admin');


        User::create([
            'name' => 'hrd',
            'email' => 'hrd@email.com',
            'divisi' => 'HRD',
            'jabatan' => 'HRD',
            'kontak' => '08999898988',
            'password' => Hash::make('hrd1234')
        ])->assignRole('approver');

        User::create([
            'name' => 'kadiv',
            'email' => 'kadiv@email.com',
            'divisi' => 'Kepala Divisi',
            'jabatan' => 'Kepala Divisi',
            'kontak' => '08999898988',
            'password' => Hash::make('kadiv1234')
        ])->assignRole('approver');

        Cuti::create([
            'user_id' => 1,
            'persalinan' => 0,
            'pernikahan' => 7,
            'tahunan' => 12
        ]);
        Cuti::create([
            'user_id' => 2,
            'persalinan' => 1,
            'pernikahan' => 7,
            'tahunan' => 12
        ]);
        
    }
}
