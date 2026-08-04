<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ImageService
{
    protected array $sizes = [
        'thumb' => 150,
        '320' => 320,
        '640' => 640,
        '1024' => 1024,
        '1600' => 1600,
    ];

    protected ImageManager $manager;

    public function __construct()
    {
        // Built directly rather than via the "image" container binding:
        // Laravel's own bundled Illuminate\Image component registers that
        // same binding name and silently shadows Intervention's, which
        // resolves the wrong (incompatible) manager.
        $this->manager = ImageManager::gd();
    }

    public function storeAnimalImage(string $path): string
    {
        $directory = (string) Str::uuid();

        Storage::disk('public')->makeDirectory("animals/{$directory}");

        $this->manager->read($path)
            ->toWebp(90)
            ->save(
                storage_path("app/public/animals/{$directory}/original.webp")
            );

        foreach ($this->sizes as $filename => $width) {

            $this->manager->read($path)
                ->scale(width: $width)
                ->toWebp(85)
                ->save(
                    storage_path("app/public/animals/{$directory}/{$filename}.webp")
                );
        }

        return $directory;
    }

    public function deleteAnimalImage(?string $directory): void
    {
        if (! $directory) {
            return;
        }

        Storage::disk('public')->deleteDirectory("animals/{$directory}");
    }
}
