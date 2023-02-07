@extends('layouts.layout')
@section('content')


        {{-- {{ dd($data) }} --}}
        {{ $data['STUDENT_ID'] . " " . $data['FNAME'] . " " . $data['LNAME'] }}

@endsection
