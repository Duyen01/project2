<link rel="stylesheet" href="{{asset('ad/dist/css/adminlte.min.css')}}">
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           
            <div class="modal-body">
                {{-- <form action="{{ route('bill.store') }}"> --}}
                    <div class="form-group">
                        <label for="name" id="lastname">Name</label>
                        <input disabled="" type="text" value="{{($bill->student->firstname) ." ".($bill->student->lastname)}}" >
                    </div>
                    <div class="form-group">
                        <label for="idTypePay">Type of Pay</label>                     
                        <input disabled="" type="text" class="form-control" value="{{$typepay->typeofpay}}">
                    </div>
                    <div class="form-group">
                        <label for="money">Money</label>                     
                        <input disabled="" type="text" class="form-control" name="money" id="money" value="{{$bill->money}}">
                    </div>
                    <div class="form-group">
                        <label for="date">Giáo vụ</label>                    
                        <input disabled="" type="text" class="form-control" name="idAdmin" value="{{ $bill->admin->name }}">
                        
                    </div>
                     <div class="form-group">
                        <label for="datetime">DateTime</label>                    
                        <input disabled="" type="text" value="{{$bill->dateTime}}">
                    </div>

                     <div class="form-group">
                        <label for="note">Note</label>                    
                        <textarea disabled="" id="note" name="note" rows="4" cols="30">{{$bill->note}}</textarea>
                    </div>
                   
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap 4 -->
<script src="{{asset('ad/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('ad/dist/js/adminlte.min.js')}}"></script>