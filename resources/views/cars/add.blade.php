@extends('admin.layouts.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="">Plate_number</label>
                  <input type="text" name="plate_number" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Owner</label>
                    <input type="text" name="owner" class="form-control" placeholder="">
                </div>
            </div>
            <div class="col-6">
                 <div class="form-group">
                    <label for="">Travel_fee</label>
                    <input type="text" name="travel_fee" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Plate_image</label>
                    <input type="file" name="plate_image" class="form-control" placeholder="">
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
