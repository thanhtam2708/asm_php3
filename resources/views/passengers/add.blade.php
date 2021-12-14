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
                    <label for="">Car</label>
                   <select name="car_id" id="" value="{{old('car_id')}}" class="form-control">
                       @foreach ($cars as $item)
                             <option value="{{$item->id}}">{{$item->owner}}</option>
                       @endforeach
                   </select>
                </div> 
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" value="{{old('avatar')}}" class="form-control" placeholder="">
                </div>
                @error('avatar')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="form-group">
                    <label for="">Travel_time</label>
                    <input type="datetime-local" name="travel_time" value="{{old('travel_time')}}" class="form-control" placeholder="">
                </div>
                @error('travel_time')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-12 d-flex justify-content-end">
                <br>
                <a href="{{route('passenger.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
       
    </form>
@endsection
