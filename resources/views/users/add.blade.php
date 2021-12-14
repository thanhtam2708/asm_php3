@extends('admin.layouts.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="">
                </div>
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="">
                </div>
                @error('email')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6">
                 <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="">
                </div>
                @error('password')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role_id" id="" class="form-control" value="{{old('role_id')}}">
                        @foreach ($role as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" class="form-control" placeholder="">
                </div>
                @error('avatar')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
               
            
            <div class="col-12 d-flex justify-content-start">
                <br>
                <a href="{{route('car.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        
    </form>

@endsection
