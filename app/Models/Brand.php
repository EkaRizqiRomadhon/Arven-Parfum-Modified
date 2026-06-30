<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['slug', 'name', 'logo', 'description', 'sort_order'];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand', 'slug');
    }
}
