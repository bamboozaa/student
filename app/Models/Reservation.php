<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $fillable = ['room', 'student_id', 'room_type', 'checkin_date', 'checkout_date'];

    public function roomtype()
    {
        return $this->hasOne(RoomType::class, 'id', 'room_type');
    }

}
