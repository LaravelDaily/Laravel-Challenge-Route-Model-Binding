<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $fillable = ['uuid', 'amount', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
