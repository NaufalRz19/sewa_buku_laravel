<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    protected function index(){
        $batas = 5;
        $jumlah_user = User::count();
        $user_list = User::orderBy('id', 'asc')->paginate($batas);
        $no = 0;
        return view('user.index', compact('user_list', 'no', 'jumlah_user'));
    }

    protected function create(){
        return view('user/create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();

        if($user->level == 'peminjam'){
            return redirect('peminjam/create');
        }
        else{
            return redirect('user');
        }
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->update();
        return redirect('user');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return redirect('user');
    }
}
