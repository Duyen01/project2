@extends('layouts.admin')
@section('main')

    <h1>Add Course</h1>
    <div class="container">
        <form action="{{ route('course.store') }}" class="was-validated" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">Name Course</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name course here...">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form> 
    </div>

@stop()