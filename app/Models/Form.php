<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trait\ImageUpload;


class Form extends Model
{
     use ImageUpload;

    protected $table = 'forms'; 
   protected  $fillable = [
        'email',
        'phone',
        'address',
        'city',
        'state',
        'gender',
   ];

}
