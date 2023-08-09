@extends('layouts.main')
@section('importcss')
    @parent
    {{-- {{ Html::style('css/custom.css') }} --}}
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap');
        body {
            font-family: 'Mitr', sans-serif;
        }
    </style>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12 text-center">
            <h2>ลงทะเบียนเข้าใช้งานห้อง</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach ($room_types as $key => $room_type)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="room_type_value" id="Radio{{ $key+1 }}" value="{{ $room_type->id }}">
                <label class="form-check-label" for="Radio{{ $key+1 }}">{{ $room_type->name }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="lab_number" name="lab_number" placeholder="หมายเลขห้อง">
        <label for="lab_number">หมายเลขห้อง</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="รหัสนักศึกษา" autofocus>
        <label for="student_id">รหัสนักศึกษา</label>
    </div>

    <div id="exampleid"></div>

<script>
    $("#student_id").on('change', function(){
        var id = $("#student_id").val();
        $.ajax({
            //url: "{{ url("students"). "/" }}"+sid,
            url: '{{ url('students/{id}') }}'.replace('{id}', id),
            //url: "{{ route('reservations.show', "sid") }}",
            type: 'GET',
            data: {
                'id': id
            },
           success: function(result){
                //console.log(result)
                $.each(result, function (key, value) {
                    $('#exampleid').append(value.FNAME+" "+value.LNAME);
                })
           }
        });
    });

</script>


@endsection
