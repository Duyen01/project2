@extends('layouts.admin')
@section('main')

    <h1>Update Tuition</h1>
    <div class="container">
        <form action="{{ route('tuition.update') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="tuitionNorm">Standard tuition:</label>
                        <input type="text" class="form-control" name="tuitionNorm" value="{{$tuition->tuitionNorm}}">
                        @error('tuitionNorm')
                        <small class="help-block">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form> 
    </div>

@stop()