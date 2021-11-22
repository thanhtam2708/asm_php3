@extends('admin.layouts.main')
@section('content')
<div class="card">
    <div class="car-body">
<table class="table table-stripped">
    <thead>
        <th>ID</th>
        <th>Plate_number</th>
        <th>Owner</th>
        <th>Travel_fee</th>
        <th>Plate_image</th>
        <th>
            <a href="{{route('car.add')}}">Add new</a>
        </th>
    </thead>
    <tbody>
        @foreach ($cars as $item)
            <tr>
               <td>{{$item->id}}</td>
                <td>{{$item->plate_number}}</td>
                <td>{{$item->owner}}</td>
                <td>{{$item->travel_fee}}</td>
                <td>
                    <img src="{{ asset($item->plate_image) }}" alt="" width="100px">
                </td>
                <td>
                    <a href="{{route('car.edit',['id'=>$item->id])}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('car.remove',['id'=>$item->id])}}" class="btn btn-danger">Remove</a>
                </td>
            </tr>
        @endforeach
      
    </tbody>
</table>
    </div>
</div>

@endsection
