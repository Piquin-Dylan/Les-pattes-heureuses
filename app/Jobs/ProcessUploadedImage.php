<?php

namespace App\Jobs;

use App\Services\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessUploadedImage implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    
    public function __construct(
        public Model $model,
        public string $tmpPath,
        public ?string $oldPhotoDirectory = null,
        public string $photoColumn = 'photo',
    ) {
    }

    public function handle(ImageService $imageService): void
    {
        if (! Storage::disk('local')->exists($this->tmpPath)) {
            Log::warning('ProcessUploadedImage: temp upload missing, skipping.', [
                'model' => $this->model::class,
                'id' => $this->model->getKey(),
                'tmpPath' => $this->tmpPath,
            ]);

            return;
        }

        $directory = $imageService->storeAnimalImage(
            Storage::disk('local')->path($this->tmpPath)
        );

        $this->model->forceFill([$this->photoColumn => $directory])->save();

        Storage::disk('local')->delete($this->tmpPath);

        $imageService->deleteAnimalImage($this->oldPhotoDirectory);
    }

    public function failed(\Throwable $exception): void
    {
        Storage::disk('local')->delete($this->tmpPath);

        Log::error('ProcessUploadedImage failed.', [
            'model' => $this->model::class,
            'id' => $this->model->getKey(),
            'error' => $exception->getMessage(),
        ]);
    }
}
