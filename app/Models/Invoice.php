<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice'; // Thiết lập tên bảng

    protected $primaryKey = 'invoice_id'; // Thiết lập khóa chính

    protected $fillable = [
        'bookingdetails_id',
        // Các trường khác nếu có
    ];

    // Định nghĩa quan hệ với bảng bookingdetails
    public function bookingDetail()
    {
        return $this->belongsTo(BookingDetails::class, 'bookingdetails_id');
    }
    public function calculateTotalAmount()
    {
        $bookingDetails = BookingDetails::find($this->bookingdetails_id);

        if ($bookingDetails) {
            $quantity = $bookingDetails->quantity;
            $roomPrice = $bookingDetails->room->room_price;

            return $quantity * $roomPrice;
        }

        return null;
    }
}
