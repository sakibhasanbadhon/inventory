<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function updateStock($quantity, $type = 'out')
    {
        if ($type === 'out') {
            $this->current_stock -= $quantity;
        } else {
            $this->current_stock += $quantity;
        }
        $this->save();
    }
    
}
