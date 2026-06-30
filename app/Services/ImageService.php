<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    protected array $sizes = [
        'thumb' => 150,
        '320' => 320,
        '640' => 640,
        '1024' => 1024,
        '1600' => 1600,
    ];

    public function storeAnimalImage(UploadedFile $file): string
    {
        $directory = (string) Str::uuid();

        Storage::disk('public')->makeDirectory("animals/{$directory}");

        Image::read($file)
            ->toWebp(90)
            ->save(
                storage_path("app/public/animals/{$directory}/original.webp")
            );

        foreach ($this->sizes as $filename => $width) {

            Image::read($file)
                ->scale(width: $width)
                ->toWebp(85)
                ->save(
                    storage_path("app/public/animals/{$directory}/{$filename}.webp")
                );
        }

        return $directory;
    }

    public function deleteAnimalImage(string $directory): void
    {
        Storage::disk('public')->deleteDirectory("animals/{$directory}");
    }
}
