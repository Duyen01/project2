@extends('layouts.admin')
@section('main')
<h1>Hi</h1>
<h2>{{Carbon\Carbon::now()->format('d-m-Y')}}</h2>
<input name="ngay_muon" type="text" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
<input name="ngay_hen_tra" type="text" value="{{Carbon\Carbon::now()->addDay(10)->format('Y-m-d')}}">
@stop()