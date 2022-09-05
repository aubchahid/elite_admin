<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->BelongsTo(Client::class);
    }

    public function products()
    {
        return $this->hasMany(DeliveryProduct::class);
    }

    public function qteCommande()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $total++;
        }
        return $total;
    }
}
