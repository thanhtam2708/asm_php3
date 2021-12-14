@extends('admin.layouts.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input disabled type="text" name="name" value="{{$model->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($role as $role)
                            <option @if ($role->id == $model->role_id)
                            selected 
                            @endif value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
              
            </div>
            <div class="col-12 d-flex justify-content-start">
                <br>
                <a href="{{route('car.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        
    </form>

@endsection
