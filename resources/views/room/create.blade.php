@extends('layouts.app')
@section('title', 'New Room')
@section('importcss')
    @parent
    {{Html::style('css/navbar.css')}}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-06">
            <h2>เพิ่มห้องใหม่</h2>
            <div>กรุณากรอกข้อมูลที่ถูกต้องครบถ้วน</div>
        </div>
        <div class="col-md-6">
            @include('includes.error')
        </div>
    </div>
    {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\RoomController@store', 'files' => true]) !!}
    <div class="card">
        <div class="card-header">
            เพิ่มห้องใหม่
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('room_name', 'ชื่อห้อง') !!}
                {!! Form::text('room_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="mb-3">{!! DNS2D::getBarcodeHTML('7401', 'QRCODE') !!}</div>

        </div>
        <div class="card-footer">
            {{ Form::submit('บันทึก', ['class' => 'btn btn-success']) }}
            {!! link_to('/rooms', $title = 'ยกเลิก', $attributes = ['class' => 'btn btn-danger'], $secure = null); !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection
