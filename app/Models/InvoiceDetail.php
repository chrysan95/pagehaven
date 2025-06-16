<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_header_id',
        'book_id',
        'quantity',
        'price'
    ];

    public function invoiceHeader()
    {
        return $this->belongsTo(InvoiceHeader::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price * $this->quantity,
        );
    }
}