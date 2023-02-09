@extends('layouts.layout')
@section('content')

    <div class="form-group">
        {!! Form::label('student_id', 'รหัสนักศึกษา') !!}
        {!! Form::text('student_id', null, ['class' => 'form-control']) !!}
    </div>

    {{ $data['STUDENT_ID'] . " " . $data['FNAME'] . " " . $data['LNAME'] }}

@endsection
