<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   protected $fillable = [
      'name',
      'phone',
      'message',
      'user_id',
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }
}
