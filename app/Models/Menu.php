<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaMenu',
        'hargaMenu',
        'deskripsiMenu',
        'stokMenu',
        'image',
        'shop_id',
        'category_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function menucategories()
    {
        return $this->belongsToMany(MenuCategory::class, 'pilih_category', 'idMenu', 'idCategory');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'checkouts', 'idMenu', 'idBooking');
    }
}
