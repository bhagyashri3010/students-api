<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";

    protected $fillable = ['name', 'email', 'phone_number', 'country', 'country_code'];
}
