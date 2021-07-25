<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'amount', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //to change the whole route model binding key use this otherwise continue with the route like(transaction:uuid)
    
    // public function getRouteKeyName()
    // {
    //     return 'uuid';
    // }
}
