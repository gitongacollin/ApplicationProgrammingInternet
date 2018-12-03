<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
	/**protected $fillable = ['first_name', 'last_name', 'sex', 'dob', 'email',  'status',
		    'nationality', 'id_card_no', 'passport', 'phone', 'district', 'division', 'location',
		    'county', 'current_address', 'dateregistered', 'photo', 'user_id'
	  ];*/ 
	protected $primaryKey = 'student_id';
	public $timestamps = false;
}
