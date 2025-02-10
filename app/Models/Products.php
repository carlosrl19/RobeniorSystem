<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    protected $fillable = [
        'product_code',
        'product_nomenclature',
        'product_name',
        'product_brand',
        'product_model',
        'product_status',
        'category_id',
        'product_stock',
        'product_price',
        'product_description',
        'product_status_description',
        'product_image',
        'product_reviewed_by',
        'created_at',
        'updated_at'
    ];
}
