<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UsersRequest;
use App\Model\Connect;
use App\Model\Design;
use App\Model\Messages;
use App\Model\Projects;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('can:isAdmin');
    }

    public function index() {
        $users = User::orderBy('id', 'desc')->paginate(20);
        $users->sortByDesc("id");
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(UsersRequest $userRequest) {
        $userRequest->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        function generateRandomString($length = 5) {
            $characters = 'abcdefghijklmnopqrstuvwxyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $users = new User;
        $users->full_name = $userRequest->full_name;
        $users->email = $userRequest->email;
        $users->password = bcrypt($userRequest->password);
        if ($userRequest->role == 'super_admin') {
            $users->role = 'user';
        } else {
            $users->role = $userRequest->role;
        }
        $users->save();

        return redirect('/dashboard/users')->with('notification', [
            'class' => 'success',
            'message' => 'User created'
        ]);
    }

    public function edit($id) {
        if ($id == auth()->user()->id || Gate::allows('isAdmin')) {
            $users = User::find($id);
            return view('admin.users.edit', compact('users'))->withInfo('User edited');
        } else {
            return redirect('/dashboard/no-permissions');
        }
    }

    public function update(Request $request, $id) {
        if ($id == auth()->user()->id || Gate::allows('isAdmin')) {

            $users = User::find($id);

            $this->validate($request, [
                'full_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $users->id,
                'role' => 'required',
            ], [], [
                'full_name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                'role' => 'Role',
            ]);


            $users->full_name = $request->full_name;
            $users->email = $request->email;
            $users->role = $request->role;
            if ($request->role == 'super_admin') {
                $users->role = 'user';
            } else {
                $users->role = $request->role;
            }

            if (empty($request->password_change)) {
            } else {
                $users->password = bcrypt($request->password_change);
            }
            $users->update($request->all());

            return back()->with('notification', [
                'class' => 'success',
                'message' => 'User Updated.'
            ]);
        } else {
            return redirect('/dashboard/no-permissions');
        }
    }

    public function destroy(Request $request) {
        foreach ($request->delete_item as $key => $item) {
            User::where('id', $key)->delete();
        }

        return redirect('/dashboard/users')->with('notification', [
            'class' => 'success',
            'message' => 'Items deleted.'
        ]);
    }

    public function AuthRouteAPI(Request $request) {
        return $request->user();
    }
}
