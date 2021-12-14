@extends('admin.layouts.main')
@section('content')
<div class="card">
    <div class="car-body">
<table class="table table-stripped">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Avatar</th>
        <th>Role</th>
        <th>
            <a href="" class="btn btn-success">Add new</a>
        </th>
    </thead>
    <tbody>
        @foreach ($users as $item)
            <tr>
               <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>
                    <img src="{{ asset($item->avatar) }}" alt="" width="100px">
                </td>
                <td>
                    {{-- <form action="" method="post">
                        <div class="row">
                            <div class="form-group">
                                <select name="role_id" id="role_id" class="form-control">
                                    @foreach ($roles as $item2)
                                    <option @if ($item2->id == $item->role_id)
                                        selected 
                                        @endif value="{{$item2->id}}">{{$item2->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <button class="btn">Save</button>
                        </div>
                    </form> --}}
                    {{$item->role->name}}
                </td>
                <td>
                    <a href="{{route('user.edit',['id'=>$item->id])}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('user.remove',['id'=>$item->id])}}" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger">Remove</a>
                    <a href="{{route('user.editRole',['id'=>$item->id])}}"class="btn btn-success">Change Role</a>
                </td>
            </tr>
        @endforeach
      
    </tbody>
</table>
    </div>
</div>

@endsection
