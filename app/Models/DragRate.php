<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DragRate extends Model
{
    use HasFactory;

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function good(){
        return $this->belongsTo(Good::class);
    }
}
