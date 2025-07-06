<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'price', 'cost', 'weight',
        'provider_id', 'category_id', 'tax_id', 'image'
    ];

    public function category()  { return $this->belongsTo(Category::class); }
    public function provider()  { return $this->belongsTo(Provider::class); }
    public function tax()       { return $this->belongsTo(Tax::class); }
    public function variants()  { return $this->hasMany(Variant::class); }
    public function discounts() { return $this->hasMany(Discount::class); }
    public function images()  { return $this->hasMany(Image::class); }
}
