<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
protected $primaryKey = 'room_id';
protected $table = 'room';

protected $fillable = [
    'HotelID',
    'room_type',
    'room_Image',
    'room_price',
    'room_no',
    'room_status',
    // Các trường khác bạn muốn thêm vào đây
];

public function hotel() {
    return $this->belongsTo(Product::class, 'HotelID', 'HotelID');
}
}
