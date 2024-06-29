<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Stats\Traits\HasStats;

class Payment extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;
    protected $guarded = [];
    protected $appends = ["image"];

    public function subscription() {
        return $this->belongsTo(Subscription::class)->with(['business', 'plan']);
    }

    protected function amount(): Attribute {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => cleanFormatedMoney($value)
        );
    }

    public function registerMediaConversions(Media|null $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getImageAttribute () {
        $images = $this->getMedia("*");
        $image = null;
        
        if (count($images) > 0) {
            $publicUrl = $images[0]->getUrl();
            $publicFullUrl = $images[0]->getFullUrl();
            $image = $publicUrl;
        }
        return $image;
    }

    public function processImageUpload() {
        // check if has image
        if (request()->hasFile('image')) {
            $this->clearMediaCollection("images");

            $this->addMediaFromRequest('image')
            ->toMediaCollection('images');
        }
    }
}
