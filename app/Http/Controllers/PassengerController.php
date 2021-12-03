<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassengerRequest;
use App\Models\Car;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PassengerController extends Controller
{
    public function index()
    {
        $passengers = Passenger::all();
        return view('passengers.index', [
            "passengers" => $passengers
        ]);
    }
    public function addForm()
    {
        $cars = Car::all();
        return view('passengers.add', compact('cars'));
    }
    public function saveAdd(PassengerRequest $request)
    {
        $model = new Passenger();
        if ($request->hasFile('avatar')) {
            $imgPath = $request->file('avatar')->store('passengers');
            // dd($imgPath);
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('passenger.index'));
    }

    public function remove($id)
    {
        $model = Passenger::find($id);
        if (!empty($model->avatar)) {
            $imgPath = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($imgPath);
        }
        $model->delete();
        return redirect(route('passenger.index'));
    }

    public function editForm($id)
    {

        $model = Passenger::find($id);
        //dd($model->travel_time);
        if (!$model) {
            return back();
        }
        $cars = Car::all();
        return view('passengers.edit', compact('model', 'cars'));
    }
    public function saveEdit(PassengerRequest $request, $id)
    {
        $model = Passenger::find($id);
        if (!$model) {
            return back();
        }
        if ($request->hasFile('avatar')) {
            $oldImg = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($oldImg);
            $imgPath = $request->file('avatar')->store('passengers');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->avatar = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('passenger.index'));
    }
}