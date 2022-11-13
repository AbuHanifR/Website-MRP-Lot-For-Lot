<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'nama' => 'PPIC',
                    'role' => 'ppic',
                    'email' => 'ppic@gmail.com',
                    'password' => Hash::make('ppic123')
                ],
                [
                    'nama' => 'Gudang',
                    'role' => 'gudang',
                    'email' => 'gudang@gmail.com',
                    'password' => Hash::make('gudang123')
                ],
                [
                    'nama' => 'Pengadaan',
                    'role' => 'pengadaan',
                    'email' => 'pengadaan@gmail.com',
                    'password' => Hash::make('pengadaan123')
                ],
                [
                    'nama' => 'Produksi',
                    'role' => 'produksi',
                    'email' => 'produksi@gmail.com',
                    'password' => Hash::make('produksi123')
                ],
            ]
        );
    }
}
