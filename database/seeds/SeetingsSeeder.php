<?php

use Illuminate\Database\Seeder;

class SeetingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting= [
          0 => [
              'name' => 'forum_on',
              'value' => '0'
          ]
        ];

        DB::table('settings')->insert($setting);
    }
}
