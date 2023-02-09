@extends('layouts.layout')
@section('content')

    <form action="{{ url('/students') }}" method="get">
        <div class="form-group">
            {!! Form::label('student_id', 'รหัสนักศึกษา') !!}
            {!! Form::text('student_id', null, ['class' => 'form-control']) !!}
        </div>
    </form>

    @php
    foreach($_GET as $key=>$val) {
        ${$key}=$val;
    }

    if (isset($student_id)) {
        $student_id = $_GET['student_id'];
        $data = DB::connection('odbc')->table('AVSREG.VIEWSTUDENTPROFILE')->where('STUDENT_ID', $student_id)->get();
        if (count($data) > 0) {
            $data = $data[0];
            foreach ($data as $key => $value) {
                $tis_arr[$key] = iconv("tis-620", "utf-8", $value);
            }
            unset($data);
        } else {
            header("Location: localhost/students");
        }

    }
    @endphp
    @if (isset($tis_arr))
        {{ $tis_arr['FNAME'] . " " . $tis_arr['LNAME'] }}
    @endif


@endsection
