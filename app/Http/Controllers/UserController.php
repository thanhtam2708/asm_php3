<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.index', [
            "users" => $users,
            "roles" => $roles
        ]);
    }
    public function addForm()
    {
        $role = Role::all();
        return view('users.add', compact('role'));
    }
    public function saveAdd(UserRequest $request)
    {
        $model = new User();
        if ($request->hasFile('avatar')) {
            $imgPath = $request->file('avatar')->store('users');
            // dd($imgPath);
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('user.index'));
    }
    public function remove($id)
    {
        if (Auth::user()->id != $id) {
            $model = User::find($id);
            if (!empty($model->avatar)) {
                $imgPath = str_replace('storage/', 'public/', $model->avatar);
                Storage::delete($imgPath);
            }
            $model->delete();
            return redirect(route('user.index'));
        } else {
            return redirect(route('403'));
        }
    }
    public function editForm($id)
    {
        $model = User::find($id);
        if (!$model) {
            return back();
        }
        return view('users.edit', compact('model'));
    }
    public function saveEdit(EditUserRequest $request, $id)
    {
        $model = User::find($id);
        if (!$model) {
            return back();
        }
        if ($request->hasFile('avatar')) {
            $oldImg = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($oldImg);
            $imgPath = $request->file('avatar')->store('users');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('user.index'));
    }

    public function editRole($id)
    {
        $role = Role::all();
        $model = User::find($id);
        if (!$model) {
            return back();
        }
        return view('users.editRole', compact('model', 'role'));
    }
    public function saveRole(Request $request, $id)
    {
        $model = User::find($id);
        if (!$model) {
            return back();
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('user.index'));
    }
    public function page403()
    {
        return view('users.403');
    }
}