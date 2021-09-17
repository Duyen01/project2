@extends('layouts.admin')
@section('main')

<h1>List Tuition</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Enter tuition..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<a href="{{route('tuition.create')}}" class="btn btn-primary">Add tuition</a>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Course</th>
                <th>Major</th>
                <th>Standard tuition</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $tuition)    
            <tr>
                <td>{{$tuition->course_name}}</td>
                <td>{{$tuition->major_name}}</td>
                <td>{{number_format($tuition->tuitionNorm)}}đ </td>
                <td>
                    <a href="{{route('tuition.edit',[$idCourse = $tuition->idCourse,$idMajor = $tuition->idMajor])}}" class="btn btn-success">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach    
        </tbody>
    </table>
    <hr>
    <div class="">
        {{$data -> appends(request()->all())->links()}}
    </div>
    @stop()