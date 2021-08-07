<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'path'];

    public static function deleteFileFromStorage($path)
    {
        Storage::disk('home-slider')->delete($path);
    }

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            $originalData = $model->getOriginal();
            $updatedData = $model->getDirty();

            if (!empty($updatedData['path']) && !empty($originalData['path']) && Storage::disk("home-slider")->exists($originalData['path'])) { {
                    self::deleteFileFromStorage($originalData['path']);
                }
            }
        });
    }
}
