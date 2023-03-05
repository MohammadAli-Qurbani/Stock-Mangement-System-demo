<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function returneds(){
        return $this->hasMany(Returned::class);
    }

    public function expirations(){
        return $this->hasMany(Expiration::class);
    }

    public function drag_rates(){
        return $this->hasMany(DragRate::class);
    }

    public function dragRate(){
        return $this->hasOne(DragRate::class);
    }
}

