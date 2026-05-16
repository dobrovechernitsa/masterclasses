<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 
        'instructor_id', 
        'title', 
        'description',
        'date', 
        'time_slot', 
        'max_participants', 
        'price'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getAvailableSpotsAttribute()
    {
        $bookedCount = $this->bookings()->where('status', 'confirmed')->count();
        return $this->max_participants - $bookedCount;
    }

    public function getTimeDisplayAttribute()
    {
        return str_replace('-', ':00-', $this->time_slot) . ':00';
    }
}