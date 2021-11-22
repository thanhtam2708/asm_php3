@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Car_name</th>
                    <th>Avatar</th>
                    <th>Travel_time</th>
                    <th>
                        <a href="{{route('passenger.add')}}" class="btn btn-success">Add new</a>
                    </th>
                </thead>
                <tbody>
                    @foreach ($passengers as $item)
                        <tr>
                        <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->car->owner}}</td>
                            <td>
                                <img src="{{asset($item->avatar)}}" alt="" width="100px">
                            </td>
                            <td>{{$item->travel_time}}</td>
                            <td>
                                <a href="{{route('passenger.edit',['id'=>$item->id])}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('passenger.remove',['id'=>$item->id])}}" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
@endsection
