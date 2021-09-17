@extends('layouts.site')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
<div class="alert-success">
</div>
    <div class="container">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-content ">
                                {{-- <form> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Email address</label>
                                                <input type="email" class="form-control" readonly name="email" value="{{ $student->email }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">First Name</label>
                                                <input type="text" class="form-control" readonly name="firstname" value="{{ $student->firstname }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Last Name</label>
                                                <input type="text" class="form-control" readonly name="lastname" value="{{ $student->lastname }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Address</label>
                                                <input type="text" class="form-control" readonly name="address" value="{{ $student->address }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Phone</label>
                                                <input type="text" class="form-control" readonly name="phone" value="{{ $student->phone }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Date of Birth</label>
                                                <input type="text" class="form-control" readonly name="dob" value="{{ $student->dob }}">
                                            <span class="material-input"></span></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Gender</label>
                                                <input type="text" class="form-control" name="idGrade" value="{{ $student->gender == 1 ? "Nam":"Nữ"}}" readonly>
                                            <span class="material-input"></span></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control">Grade</label>
                                                <input type="text" class="form-control" name="idGrade" value="{{ $student->grade->name }}" readonly>
                    
                                            <span class="material-input"></span></div>
                                        </div>
                                    </div>
                                    
                                {{-- </form> --}}
                                {{-- {{ route('') }} --}}
                                <button id="openModal" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                                    Change password
                                </button>
                                    <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <div class="alert alert-danger" style="display:none"></div>
          <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <form action="{{ route('change.passwordUser') }}" method="POST" enctype="multipart/form"> --}}
            @csrf
            {{-- @method('PUT') --}}
            <div class="form-group">
                <label for="password">Your old Password</label>                
                <input type="password" name="oldpassword" id="oldpassword" class="form-control">
               
                <label for="password">Your new password</label>                
                <input type="password" name="password" id="password" class="form-control">
               
                <label for="password">Confirm your password</label>               
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
               
                
            </div>
              <button id="ajaxSubmit" type="submit" class="btn btn-primary" >Save changes</button>
          {{-- </form> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
        </div>
      </div>
    </div>
</div>
@section('js')
<script>
    jQuery(document).ready(function(){
      jQuery('#exampleModal').click(function(e){
         e.preventDefault();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
         jQuery.ajax({
            url: "{{ url('/profile/change') }}",
            method: 'post',
            data: {
               oldpassword: jQuery('#oldpassword').val(),
               password: jQuery('#password').val(),
               password_confirmation: jQuery('#password_confirmation').val(),
            },
            success: function(result){
                if(result.errors)
                {
                    jQuery('.alert-danger').html('');

                    jQuery.each(result.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<li>'+value+'</li>');
                    });
                } 
                else
                {
                    jQuery('.alert-danger').hide();
                    // $('#open').hide();
                    $('#exampleModal').modal('hide');
                }
            }});
         });
      });
</script>
@endsection
<!-- Button trigger modal -->  
  <!-- Modal -->