<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Pages = [
            [
                'title' => 'About Us',
                'url' => 'about-us',
                'meta_title' => 'About Us',
                'meta_keywords' => 'About Us',
                'meta_description' => 'About Us',
                'status' => '1',
            ],
            [
                'title' => 'Privacy Policy',
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy Policy',
                'meta_keywords' => 'Privacy Policy',
                'meta_description' => 'Privacy Policy',
                'status' => '1',
            ],
            [
                'title' => 'Terms and Conditions',
                'url' => 'terms-and-conditions',
                'meta_title' => 'Terms and Conditions',
                'meta_keywords' => 'Terms and Conditions',
                'meta_description' => 'Terms and Conditions',
                'status' => '1',
            ],
        ];

        //create the records in the database table with out forloop
        CmsPage::insert($Pages);

    }
}
