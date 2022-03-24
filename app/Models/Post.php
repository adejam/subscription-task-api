<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'description',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }

    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function setDescriptionAttribute(string $value): void
    {
        $this->attributes['description'] = strtolower($value);
    }
}
