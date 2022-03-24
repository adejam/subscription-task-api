<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert(array(
            0 => array(
                'website_name' => 'inisiv.com',
            ),
            1 => array(
                'website_name' => 'laravel.com',
            ),
            2 => array(
                'website_name' => 'google.com',
            ),
            3 => array(
                'website_name' => 'github.com',
            ),
        ));
    }
}
