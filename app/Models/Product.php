<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumb_image',
        'name',
        'slug',
        'category_id',
        'price',
        'offer_price',
        'quantity',
        'short_description',
        'long_description',
        'sku',
        'seo_title',
        'seo_description',
        'show_at_home',
        'status'
    ];

}
