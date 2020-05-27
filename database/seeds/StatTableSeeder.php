<?php

use App\Stat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $stats = [
            ['name' => 'Health', 'default' => 100, 'default_max_value' => 100, 'display' => true],
            ['name' => 'Money', 'default' => 0, 'display' => true],
            ['name' => 'Level', 'default' => 1, 'display' => true],
            ['name' => 'Experience', 'default' => 0, 'default_max_value' => 17, 'display' => true],
        ];

        foreach ($stats as $stat)
        {
            Stat::create($stat);
        }
    }
}
