<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'nome' => 'Usuário Admin',
            'email' => 'admin@mail.com',
            
            'secao_id' => 6,
            'password' => bcrypt('abc123')]);

        DB::table('users')->insert([
            'nome' => 'Usuário Perito',
            'email' => 'perito@mail.com',
            
            'secao_id' => 6,
            'password' => bcrypt('abc123')]);
    }
}
