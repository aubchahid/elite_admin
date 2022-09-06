<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['is_deleted'];


    public function client()
    {
        return $this->BelongsTo(Client::class);
    }

    public function products()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function sumInvoice()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item->product->unit_price * $item->qte;
        }
        return $total;
    }

    public function totalTVA()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item->product->unit_price * $item->qte;
        }
        return ($total / 100) * 20;
    }


    public function totalNotPaid($invoice)
    {
        $total = 0;
        foreach ($invoice as $item) {
            $total += $item->sumInvoice();
        }
        return $total;
    }
}
