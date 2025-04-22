<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrasileiraoLancamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Local directory where images are stored
        $localImagePath = '/Applications/projetos/dia22/imagenscamisa/sao_paulo';

        // Get all image files from the directory
        $imageFiles = glob($localImagePath . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        foreach ($imageFiles as $imageFile) {
            // Generate a unique filename
            $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
            $filename = Str::random(40) . '.' . $extension;

            // Read the file contents
            $fileContents = file_get_contents($imageFile);

            // Store the file in Laravel's storage (will be uploaded to Railway's storage)
            $path = Storage::putFileAs('products', $imageFile, $filename);

            // Extract product name from filename (optional)
            $productName = pathinfo($imageFile, PATHINFO_FILENAME);
            $productName = str_replace('_', ' ', $productName); // Replace underscores with spaces
            $productName = ucwords($productName); // Capitalize words

            // Insert into database
            DB::table('products')->insert([
                'category' => 'brasileirao_lancamentos',
                'name' => $productName,
                'size' => 'M', // Default size or you can randomize
                'description' => 'Camisa oficial do time ' . $productName . ' - Temporada 2024',
                'price' => rand(20000, 35000) / 100, // Random price between 200.00 and 350.00
                'image' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
