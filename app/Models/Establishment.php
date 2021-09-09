<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'image_principal',
        'address',
        'lat',
        'lng',
        'tlf',
        'description',
        'opening',
        'closing',
        'uuid',
        'user_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
