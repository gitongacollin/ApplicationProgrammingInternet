<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $fillable = ['receipt_id'];
    public $timestamps=false;


    static public function autoNumber()
    {
    	$id=0;
    	$receipt_id = Receipt::max('receipt_id');
    	if($receipt_id!=0)
    	{
    		$id = $receipt_id+1;
    		Receipt::insert(['receipt_id'=>$id]);
    	}else{
    		$id = 1;
    		Receipt::insert(['receipt_id'=>$id]);
    	}
    	return $id;
    }
}

