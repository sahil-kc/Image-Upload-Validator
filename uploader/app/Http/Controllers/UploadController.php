<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UploadController extends Controller {
	public function uploader(Request $request){
		$file = $request->file('image');
		echo $file;
		$file->move('uploads', $file->getClientOriginalName());
		echo "Uploaded";
	}
}