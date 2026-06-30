<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ─── YSL ──────────────────────────────────────────────
            ['name' => 'YSL Y Eau de Parfum',      'brand' => 'ysl', 'price' => 1800000, 'stock' => 20, 'description' => 'Parfum maskulin modern, segar dan clean.',                 'image' => 'ysl_y_edp.jpg'],
            ['name' => "YSL La Nuit De L'Homme",   'brand' => 'ysl', 'price' => 2500000, 'stock' => 15, 'description' => 'Parfum malam sensual dan warm.',                         'image' => 'ysl_lanuit.jpg'],
            ['name' => "YSL L'Homme",               'brand' => 'ysl', 'price' => 1700000, 'stock' => 18, 'description' => 'Fresh woody yang classy dan elegant.',                   'image' => 'ysl_lhomme.jpg'],
            ['name' => 'YSL Y Le Parfum',           'brand' => 'ysl', 'price' => 2848000, 'stock' => 10, 'description' => 'Versi intense dan lebih gelap.',                         'image' => 'ysl_y_leparfum.jpg'],
            ['name' => 'YSL Kouros',                'brand' => 'ysl', 'price' => 1233000, 'stock' => 12, 'description' => 'Klasik maskulin dengan karakter kuat.',                  'image' => 'ysl_kouros.png'],
            ['name' => 'YSL Black Opium',           'brand' => 'ysl', 'price' => 1644000, 'stock' => 16, 'description' => 'Manis, bold, dan addictive.',                            'image' => 'ysl_BlackOpium.jpg'],

            // ─── Dior ─────────────────────────────────────────────
            ['name' => 'Dior Sauvage EDT',          'brand' => 'dior', 'price' => 2200000, 'stock' => 25, 'description' => 'Spicy fresh maskulin dengan ketahanan kuat.',          'image' => 'dior_sauvage_edt.jpg'],
            ['name' => 'Dior Sauvage EDP',          'brand' => 'dior', 'price' => 2400000, 'stock' => 20, 'description' => 'Lebih deep, smooth, dan elegan.',                      'image' => 'dior_sauvage_edp.jpg'],
            ['name' => 'Dior Homme Intense',        'brand' => 'dior', 'price' => 1950000, 'stock' => 14, 'description' => 'Iris powdery yang elegan dan gentleman.',              'image' => 'dior_homme_intense.jpg'],
            ['name' => 'Dior Fahrenheit',           'brand' => 'dior', 'price' => 1975000, 'stock' => 12, 'description' => 'Leather klasik dengan karakter kuat.',                 'image' => 'dior_fahrenheit.jpg'],
            ['name' => 'Dior Homme',                'brand' => 'dior', 'price' => 2869000, 'stock' => 10, 'description' => 'Modern clean woody yang versatile.',                   'image' => 'dior_homme.jpg'],
            ['name' => 'Dior Homme Sport',          'brand' => 'dior', 'price' => 2750000, 'stock' => 15, 'description' => 'Fresh citrus energik untuk outdoor.',                  'image' => 'dior_homme_sport.jpg'],

            // ─── Chanel ───────────────────────────────────────────
            ['name' => 'Bleu de Chanel EDT',        'brand' => 'chanel', 'price' => 2000000, 'stock' => 20, 'description' => 'Fresh citrus woody yang versatile.',                'image' => 'bleu_chanel_edt.jpg'],
            ['name' => 'Bleu de Chanel EDP',        'brand' => 'chanel', 'price' => 2500000, 'stock' => 18, 'description' => 'Smooth, elegant, dan lebih deep.',                  'image' => 'bleu_chanel_edp.png'],
            ['name' => 'Allure Homme Sport',        'brand' => 'chanel', 'price' => 2000000, 'stock' => 16, 'description' => 'Fresh sporty, energik, dan youthful.',              'image' => 'allure_homme_sport.png'],
            ['name' => 'Chanel Égoïste Platinum',  'brand' => 'chanel', 'price' => 1644000, 'stock' => 10, 'description' => 'Clean fougere yang maskulin dan timeless.',          'image' => 'egoiste_platinum.png'],
            ['name' => 'Chanel Coco',               'brand' => 'chanel', 'price' => 2648000, 'stock' => 12, 'description' => 'Elegant, classy, dan iconic.',                      'image' => 'chanel_coco.png'],

            // ─── HMNS ─────────────────────────────────────────────
            ['name' => 'HMNS Alpha',                'brand' => 'hmns', 'price' => 320000, 'stock' => 30, 'description' => 'Segar, modern, clean – citrus & marine.',              'image' => 'hmns_alpha.png'],
            ['name' => 'HMNS Orgasm',               'brand' => 'hmns', 'price' => 370000, 'stock' => 25, 'description' => 'Woody–aromatic yang clean dan elegan.',               'image' => 'hmns_orgasm.jpg'],
            ['name' => 'HMNS Farhampthon',          'brand' => 'hmns', 'price' => 370000, 'stock' => 20, 'description' => 'Hangat, spicy, dan sensual.',                          'image' => 'hmns_farhampthon.png'],

            // ─── Mykonos ──────────────────────────────────────────
            ['name' => 'Mykonos Aphrodite',         'brand' => 'mykonos', 'price' => 250000, 'stock' => 30, 'description' => 'Aroma pantai yang segar, citrus & sea-breeze.',    'image' => 'mykonos_aphrodite.png'],
            ['name' => 'Mykonos Luminos',           'brand' => 'mykonos', 'price' => 150000, 'stock' => 35, 'description' => 'Ringan dan segar untuk aktivitas outdoor.',         'image' => 'mykonos_luminos.png'],
            ['name' => 'Mykonos Monaco Royal',      'brand' => 'mykonos', 'price' => 150000, 'stock' => 25, 'description' => 'Versi malam yang hangat dan sensual.',              'image' => 'mykonos_monaco royal.jpg'],
            ['name' => 'Mykonos Glitch',            'brand' => 'mykonos', 'price' => 250000, 'stock' => 20, 'description' => 'Fresh modern scent dengan karakter unik.',          'image' => 'mykonos_glitch.png'],
            ['name' => 'Mykonos Enchanted',         'brand' => 'mykonos', 'price' => 150000, 'stock' => 28, 'description' => 'Soft & elegant untuk daily use.',                  'image' => 'mykonos_enchanted.png'],

            // ─── Saff & Co ────────────────────────────────────────
            ['name' => 'Saff & Co Cascavel',        'brand' => 'saffnco', 'price' => 289000, 'stock' => 20, 'description' => 'Parfum Middle Eastern, bold dan mewah.',           'image' => 'saffcascavel.jpg'],
            ['name' => 'Saff & Co Loui',            'brand' => 'saffnco', 'price' => 150000, 'stock' => 25, 'description' => 'Floral manis dan feminin.',                         'image' => 'saffloui.png'],
            ['name' => 'Saff & Co SOTB',            'brand' => 'saffnco', 'price' => 300000, 'stock' => 18, 'description' => 'Fresh marine maskulin.',                            'image' => 'saffsotb.jpg'],
            ['name' => 'Saff & Co COCO',            'brand' => 'saffnco', 'price' => 300000, 'stock' => 15, 'description' => 'Summer fresh dengan vibe pantai.',                  'image' => 'saffcoco.png'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
