<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Models\User;
Use Validator;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [ 
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
		]);

		if ($validator->fails()) { 
			return response()->json([
				'messages' => $validator->errors()
			], 400); 
		} else {
			$inputs = $request->all();

			$inputs['password'] = bcrypt($inputs['password']);

			$user = User::create($inputs);
			$token = $user->createToken('ConCloud')->accessToken;
			
			$user->api_token = $token;
			$user->save();

			$isAuth = Auth::attempt([
				'email' => $request->email, 
				'password' => $request->password
			], true);

			return response()->json([
				'user' => $user,
				'token' => $token,
				'isAuth' => $isAuth,
				'message' => 'Регистрация прошла успешно!'
			], 200); 
		}
	}

	public function login(Request $request) { 
		if ($is = Auth::attempt([
			'email' => request('email'), 
			'password' => request('password')
		], $request->remember)) { 
			$user = Auth::user(); 
			$token = $user->createToken('ConCloud')->accessToken;
			$user->api_token = $token;
			$user->save();

			return response()->json([
				'user' => $user,
				'token' => $token,
				'isAuth' => $is,
				'message' => 'Вы успешно вошли!'
			], 200); 
		} else{ 
			return response()->json([
				'message' => 'Неверный e-mail или пароль.'
			], 401); 
		} 
	}

	public function getUser(Request $request) {
		return [Auth::user()];
		
	}
}
