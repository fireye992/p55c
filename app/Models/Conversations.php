<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    use HasFactory;

    protected $fillable=[
        'sender_id',
        'receiver_id',
        'last_time_message',
    ];

    //relationships

    public function messages( )
    {
return $this->hasMany(Messaje::class, 'conversation_id');

        # code...
    }

    public function user( )
    {
   return $this->belongsTo(User::class);
        # code...
    }
}