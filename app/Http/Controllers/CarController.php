<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', [
            'cars' => $cars
        ]);
    }
    public function addForm()
    {
        return view('cars.add');
    }
    public function saveAdd(CarRequest $request)
    {
        $model = new Car();
        if ($request->hasFile('plate_image')) {
            $imgPath = $request->file('plate_image')->store('cars');
            // dd($imgPath);
            $imgPath = str_replace('public/', '', $imgPath);
            $model->plate_image = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('car.index'));
    }
    public function remove($id)
    {
        $model = Car::find($id);
        $passengers = Passenger::where('car_id', '=', $id)->get();
        foreach ($passengers as $key => $value) {
            $value->delete();
        }
        if (!empty($model->plate_image)) {
            $imgPath = str_replace('storage/', 'public/', $model->plate_image);
            Storage::delete($imgPath);
        }
        $model->delete();
        return redirect(route('car.index'));
    }

    public function editForm($id)
    {
        $model = Car::find($id);
        if (!$model) {
            return back();
        }
        return view('cars.edit', compact('model'));
    }
    public function saveEdit(CarRequest $request, $id)
    {
        $model = Car::find($id);
        if (!$model) {
            return back();
        }
        if ($request->hasFile('plate_image')) {
            $oldImg = str_replace('storage/', 'public/', $model->plate_image);
            Storage::delete($oldImg);
            $imgPath = $request->file('plate_image')->store('cars');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->plate_image = $imgPath;
        }
        $model->fill($request->all());
        $model->save();
        return redirect(route('car.index'));
    }
}