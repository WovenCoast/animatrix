<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Javaabu\Helpers\Media\UpdateMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, UpdateMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'published',
        'published_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime:Y-m-d H:i',
    ];

    protected $appends = [
        "featured_image",
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i');
    }

    public function getFeaturedImageAttribute()
    {
        return $this->getFirstMedia("featured_image");
//        return $this->getFirstMediaUrl("featured_image", "large");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function registerMediaConversions(Media|null $media = null): void
    {
//        $this
//            ->addMediaConversion('large')
//            ->fit(Fit::Contain, 1920, 1080)
//            ->nonQueued();

        $this
            ->addMediaConversion('large')
            ->fit(Fit::Contain, 1232, 528)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 432, 243)
            ->nonQueued();
    }
}
