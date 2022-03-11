<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
    public function registerApp(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required|min:2',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'kelas' => $request->kelas,
            'password' => bcrypt($request->password)
        ]);
       
        $token = User::where('email', '=', $request->email)->first();
        return response()->json($token, 200);
    }
public function saveToken(Request $request)
    {
 
        $user = User::find($request->id);
        $user->token = $request->token;
        $user->save();
        $token = User::find($request->id);
        return response()->json( $token, 200);
    }
 public function update(Request $request, $id)
    {
 
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();
        $token = User::find($id);
        return response()->json(['token' => $token], 200);
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  
    public function loginApp(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = User::where('email', '=', $request->email)->first();
            return response()->json( $token, 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  
    public function index(){
        return User::all();
    }
    public function book(Request $request){
        $kolom=$request->author;
        $kunci=$request->title;
        $token = Book::where($kolom, 'like', '%' .$kunci  . '%');
        if($token->count()>0){
            return response()->json( $token->get(), 200);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
