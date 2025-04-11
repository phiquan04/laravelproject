<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'HotelID';
    protected $table = 'products';
    public $timestamps = true; // Sử dụng timestamps
    protected $fillable = [
        'name',
        'ImageHotel',
        'NumberOfRooms',
        'address',
        'status',
        // Các trường khác bạn muốn thêm vào đây
    ];
}
