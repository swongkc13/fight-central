<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fighter;

class FightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fighter::create([
            'name' => 'Paddy Pimblett',
            'nickname' => 'The Baddy',
            'division' => 'Lightweight',
            'record' => '12-2',
        ]);

        Fighter::create([
            'name' => 'Khabib Nurmagomedov',
            'nickname' => 'The Eagle',
            'division' => 'Lightweight',
            'record' => '29-0',
        ]);
    }
}
