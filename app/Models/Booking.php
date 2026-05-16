<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $user_id
 * @property int $master_class_id
 * @property string $status
 * @property-read User $user
 * @property-read MasterClass $masterClass
 */


class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'master_class_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterClass()
    {
        return $this->belongsTo(MasterClass::class);
    }
}
