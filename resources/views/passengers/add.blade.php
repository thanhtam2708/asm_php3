@extends('admin.layouts.main')
@section('content')
     <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Car</label>
                   <select name="car_id" id="" class="form-control">
                       @foreach ($cars as $item)
                             <option value="{{$item->id}}">{{$item->owner}}</option>
                       @endforeach
                   </select>
                </div> 
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Travel_time</label>
                    <input type="datetime-local" name="travel_time" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <br>
                <a href="{{route('passenger.index')}}" class="btn btn-danger">Hủy</a>
                &nbsp;
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
       
    </form>
@endsection
