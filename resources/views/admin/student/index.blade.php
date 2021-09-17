@extends('layouts.admin')
@section('main')

<h1>List Student</h1>
{{-- Form imported_file --}}
<div class="form-group">
    <form class="form-inline" action="{{route('student.import')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="imported_file"/>
                <label class="custom-file-label">Choose file</label>
                {{-- @error('imported_file')
                <small class="help-block">{{ $message }}</small>
            @enderror --}}
            </div>
        </div>
        <button style="margin-left: 10px;" class="btn btn-info" type="submit">Import</button>
    </form>
    {{-- Error input excel import --}}
    @if (count($errors) > 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> Error!</h4>
                  @foreach($errors->all() as $error)
                  {{ $error }} <br>
                  @endforeach      
              </div>
            </div>
        </div>
    @endif
    {{-- End error --}}
</div>
{{-- End import--}}
{{-- Form export_file --}}
<div class="float-right">
    <form class="form-inline" action="{{route('student.export')}}" enctype="multipart/form-data">
        @csrf
            <select name="grade" class="form-control">
                <option value="">Select grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" id="idGrade">{{($grade->name) }}</option>
                @endforeach
            </select>
            <button class="btn btn-dark" type="submit">Export student</button>
    </form>
</div>
{{-- End export --}}
    <div class="form-group">
        <input class="form-control" id="key" name="key" value="{{$key}}" class="form-control" placeholder="Enter name..." aria-describedby="helpId">
    </div>
<hr>
<a href="{{route('student.create')}}" class="btn btn-primary">Add student</a>
<hr>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                {{-- <th>Id</th> --}}
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Scholarships</th>
                <th>Type Of Pay</th>
                {{-- <th>Status</th> --}}
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $student)    
            <tr>
                <td>{{$student->firstname}}</td>
                <td>{{$student->lastname}}</td>
                <td>{{$student->gender==1?"Male":"Female"}}</td>
                <td>{{$student->grade ->name}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->address}}</td>
                <td>{{$student->phone}}</td>
                <td>{{$student->dob}}</td>
                <td>{{number_format($student->scholarships ->money)}}đ</td>
                <td>{{$student->typeofpay ->typeofpay}}</td>
                <td>
                    <a href="{{route('student.edit', $student->id)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>           
            </tr>
        @endforeach    
        </tbody>
    </table>
    <hr>
 {{--    <div class="">
        {{$data -> appends(request()->all())->links()}}
    </div> --}}
    @stop()
    @section('js')
    <script type="text/javascript">
            $('#key').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('student.search') }}',
                    data: {
                        'key': $value,
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
        @stop()