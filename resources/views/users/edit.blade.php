@extends('admin.layouts.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" value="{{$model->name}}" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{$model->email}}" placeholder="">
                </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" value="{{$model->avatar}}" class="form-control" placeholder="">
                    <img src="{{asset($model->avatar)}}" alt="" width="100">
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
