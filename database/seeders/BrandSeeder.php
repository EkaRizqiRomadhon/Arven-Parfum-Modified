<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['slug' => 'ysl',     'name' => 'Yves Saint Laurent', 'logo' => 'brand/ysl.png',       'description' => 'Parfum mewah dengan karakter elegan dan sophisticated', 'sort_order' => 1],
            ['slug' => 'dior',    'name' => 'Dior',               'logo' => 'brand/Dior_Logo.webp', 'description' => 'Keanggunan klasik Prancis dalam setiap aroma',           'sort_order' => 2],
            ['slug' => 'chanel',  'name' => 'Chanel',             'logo' => 'brand/chanel.png',     'description' => 'Ikonik, timeless, dan penuh dengan kemewahan',            'sort_order' => 3],
            ['slug' => 'hmns',    'name' => 'HMNS',               'logo' => 'brand/HMNS.png',       'description' => 'Aroma modern yang fresh dan sophisticated',               'sort_order' => 4],
            ['slug' => 'mykonos', 'name' => 'Mykonos',            'logo' => 'brand/mykonos.jpeg',   'description' => 'Kesegaran Mediterania dalam setiap semprotan',            'sort_order' => 5],
            ['slug' => 'saffnco', 'name' => 'Saff & Co',          'logo' => 'brand/SAFF N CO.png',  'description' => 'Koleksi parfum eksklusif dengan sentuhan oriental',        'sort_order' => 6],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
