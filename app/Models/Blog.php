<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
        'image',
        'review',
        'HotelName',
        'userid',
        // Các trường khác bạn muốn thêm vào đây
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
