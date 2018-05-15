<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
   protected $fillable = ['name','album_id','photo'];

   protected $table = 'photos';

   public function album() {

       return $this->belongsTo(Album::class);
   }
}
