<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Storage;

class FilesController extends Controller
{
	public function getAll(Request $request)
	{
		$user = $request->user();
		return $user->files()->get()->toArray();
	}

	public function upload(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'file' => 'required|max:15360',
			'contacts' => 'required',
			'contract_end' => 'required',
			'contract_conclusion' => 'required',
			'contract_termination' => 'required',
		]);
		
		if ($validator->fails()) {
			return response()->json([
				'messages' => $validator->errors()
			], 400);
		} elseif ($request->hasFile('file')) {
			$user = $request->user();
			$file = $request->file('file');
			$originalName = $file->getClientOriginalName();
			
			$uploadName = 'user'.$user->id.'_'.$originalName;
			$uploadContent = file_get_contents($file);

			$isUploaded = Storage::disk('google')
				->put('1Xxmh8avdDmy3J13gwAT6suL1EWpJT6_r/'.$uploadName, $uploadContent);

			if ($isUploaded) {
				$file = $user->files()->create([
					'name' => $request->name,
					'file_name' => $uploadName,
					'contacts' => $request->contacts,
					'contract_end' => $request->contract_end,
					'contract_conclusion' => $request->contract_conclusion,
					'contract_termination' => $request->contract_termination,
				]);

				return response()->json([
					'file' => $file,
					'message' => 'Файл успешно загружен'
				], 200);
			} else {
				return false;
			}
		}
	}
}
