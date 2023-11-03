<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type_id',
        'description',
        'image_cover',
        'price_product',
        'price_service',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'views'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function incrementReadCount()
    {
        $this->views++;
        return $this->save();
    }
}
