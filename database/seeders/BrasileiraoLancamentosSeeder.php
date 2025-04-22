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

        // Use transaction for safety
        DB::transaction(function () use ($imageFiles) {
            foreach ($imageFiles as $imageFile) {
                try {
                    // Generate a unique filename
                    $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
                    $filename = Str::random(40) . '.' . $extension;

                    // Store the file in Laravel's storage
                    $path = Storage::putFileAs('products', $imageFile, $filename);

                    // Process product name
                    $productName = pathinfo($imageFile, PATHINFO_FILENAME);
                    $productName = ucwords(str_replace('_', ' ', $productName));

                    // Check if product already exists
                    $existingProduct = DB::table('products')
                        ->where('name', $productName)
                        ->where('category', 'brasileirao_lancamentos')
                        ->first();

                    if (!$existingProduct) {
                        // Insert into database if doesn't exist
                        DB::table('products')->insert([
                            'category' => 'brasileirao_lancamentos',
                            'name' => $productName,
                            'size' => 'M',
                            'description' => 'Camisa oficial do time ' . $productName . ' - Temporada 2024',
                            'price' => rand(20000, 35000) / 100,
                            'image' => $path,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        // Update existing record if needed
                        DB::table('products')
                            ->where('id', $existingProduct->id)
                            ->update([
                                'image' => $path,
                                'price' => rand(20000, 35000) / 100,
                                'updated_at' => now(),
                            ]);
                    }
                } catch (\Exception $e) {
                    // Log error and continue with next image
                    logger()->error('Error processing image: ' . $imageFile, ['error' => $e->getMessage()]);
                    continue;
                }
            }
        });
    }
}
