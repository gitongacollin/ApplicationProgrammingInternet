<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use File;
use Storage;
class FileUpload extends Model
{
	public static function photo($request, $fileName, $default = "")
	{
		$name = "";
		$photo = $request->photo;
		if($request)
		{
			$extension = substr(strrchr($photo,'.'),1);
			$name = rand(11111, 99999) . "." . date('Y-m-d') . "." . time() . "." . $extension;
			Storage::disk('photo')->put($name, $photo);
		} else {
			$name = $default;
		}
		return $name;
	}
}
