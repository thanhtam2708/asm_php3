<?php

namespace App\Http\Controllers;

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
    public function saveAdd(Request $request)
    {
        $model = new User();
        if ($request->hasFile('avatar')) {
            $imgPath = $request->file('avatar')->store('public/users');
            // dd($imgPath);
            $imgPath = str_replace('public/', 'storage/', $imgPath);
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
    public function saveEdit(Request $request, $id)
    {
        $model = User::find($id);
        if (!$model) {
            return back();
        }
        if ($request->hasFile('avatar')) {
            $oldImg = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($oldImg);
            $imgPath = $request->file('avatar')->store('public/users');
            $imgPath = str_replace('public/', 'storage/', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('user.index'));
    }
    public function saveRole($e)
    {
        echo "<script>console.log('Debug Objects: " . $e . "' );</script>";
    }
}