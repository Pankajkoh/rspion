<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'author',
        'title',
        'description',
        'updated_at',
        'created_at',
    ];

    const status = [
        1 => 'Active',
        0 => 'Inactive',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog_banner_image')->singleFile();
    }
    public function get_category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

}
