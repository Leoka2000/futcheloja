<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'america' => 'América',
            'europa' => 'Europa',
            'asia' => 'Ásia',
            'africa' => 'África',
            'liga_alema' => 'Liga Alemã',
            'liga_espanhola' => 'Liga Espanhola',
            'liga_inglesa' => 'Liga Italiana',
            'outra_liga' => 'Outra Liga',
            'paulistas' => 'Paulistas',
            'mineiros' => 'Mineiros',
            'nordestinos' => 'Nordestinos',
            'ultimos_lancamentos' => 'Últimos Lançamentos',
            'edicao_retro' => 'Edição Retro',
            'brasileirao_lancamentos' => 'Brasileirão Lançamentos',
        ];


        $imageUrls = [
            'https://source.unsplash.com/random/800x800/?barcelona,jersey',
            'https://source.unsplash.com/random/800x800/?realmadrid,jersey',
            'https://source.unsplash.com/random/800x800/?juventus,jersey',
            'https://source.unsplash.com/random/800x800/?corinthians,jersey',
            'https://source.unsplash.com/random/800x800/?atletico-mineiro,jersey',
            'https://source.unsplash.com/random/800x800/?flamengo,jersey',
            'https://source.unsplash.com/random/800x800/?fluminense,jersey',
            'https://source.unsplash.com/random/800x800/?sport,jersey',
            'https://source.unsplash.com/random/800x800/?psg,jersey',
            'https://source.unsplash.com/random/800x800/?football,shirt',
        ];

        $products = [
            [
                'category' => 'america',
                'name' => 'Camisa América 2023',
                'size' => 'M',
                'description' => 'Camisa oficial do América temporada 2023, material dry-fit.',
                'price' => 249.99,
            ],
            [
                'category' => 'europa',
                'name' => 'Camisa Barcelona 2024',
                'size' => 'G',
                'description' => 'Camisa do Barcelona edição especial 2024, tecido premium.',
                'price' => 349.99,
            ],
            [
                'category' => 'liga_espanhola',
                'name' => 'Camisa Real Madrid Retro',
                'size' => 'P',
                'description' => 'Edição retrô do Real Madrid anos 90, algodão.',
                'price' => 299.99,
            ],
            [
                'category' => 'liga_inglesa',
                'name' => 'Camisa Juventus 2024',
                'size' => 'GG',
                'description' => 'Camisa oficial da Juventus temporada 2023/2024.',
                'price' => 329.99,
            ],
            [
                'category' => 'paulistas',
                'name' => 'Camisa Corinthians 2024',
                'size' => 'M',
                'description' => 'Camisa do Corinthians temporada 2024, tecnologia anti-transpirante.',
                'price' => 279.99,
            ],
            [
                'category' => 'mineiros',
                'name' => 'Camisa Atlético Mineiro 2024',
                'size' => 'G',
                'description' => 'Camisa do Galo edição especial 2024, material sustentável.',
                'price' => 269.99,
            ],
            [
                'category' => 'ultimos_lancamentos',
                'name' => 'Camisa PSG 2024',
                'size' => 'M',
                'description' => 'Novo lançamento do PSG com tecnologia de resfriamento.',
                'price' => 379.99,
            ],
            [
                'category' => 'edicao_retro',
                'name' => 'Camisa Flamengo 1981',
                'size' => 'P',
                'description' => 'Edição retrô do Flamengo campeão mundial 1981.',
                'price' => 259.99,
            ],
            [
                'category' => 'brasileirao_lancamentos',
                'name' => 'Camisa Fluminense 2024',
                'size' => 'G',
                'description' => 'Novo lançamento do Fluminense para o Brasileirão 2024.',
                'price' => 289.99,
            ],
            [
                'category' => 'nordestinos',
                'name' => 'Camisa Sport 2024',
                'size' => 'M',
                'description' => 'Camisa oficial do Sport Recife temporada 2024.',
                'price' => 239.99,
            ],
        ];

        foreach ($products as $product) {
            // Download and store the image
            $imageUrl = $imageUrls[array_rand($imageUrls)];
            $imagePath = $this->storeImage($imageUrl);

            DB::table('products')->insert([
                'category' => $product['category'],
                'name' => $product['name'],
                'size' => $product['size'],
                'description' => $product['description'],
                'price' => $product['price'],
                'image' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Download and store an image from URL
     */
    private function storeImage(string $url): string
    {
        try {
            $contents = file_get_contents($url);
            $filename = 'products/' . Str::random(40) . '.jpg';

            Storage::disk('public')->put($filename, $contents);

            return 'storage/' . $filename;
        } catch (\Exception $e) {
            // Fallback to a default image if download fails
            return 'storage/products/default.jpg';
        }
    }
}
