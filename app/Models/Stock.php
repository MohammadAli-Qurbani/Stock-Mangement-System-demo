<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function selles()
    {
        return $this->hasMany(Sell::class);
    }

    public function drag_rates()
    {
        return $this->hasMany(DragRate::class)->groupBy('stock_id');
    }


    public function drag_rateCompanies()
    {
        return $this->hasMany(DragRate::class)->distinct('stock_id');
    }

    public function returneds(){
        return $this->hasMany(Returned::class);
    }
}
