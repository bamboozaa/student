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
    {{-- {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\ReservationController@store']) !!} --}}
    {{-- <form id="#myForm">
        @csrf
        <div class="row">
            {{-- <div class="col-md-12">
                @foreach ($room_types as $key => $room_type)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="room_type_value" id="Radio{{ $key+1 }}" value="{{ $room_type->id }}">
                    <label class="form-check-label" for="Radio{{ $key+1 }}">{{ $room_type->name }}</label>
                </div>
                @endforeach
            </div> --}}
    {{-- </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="lab_number" name="room" placeholder="หมายเลขห้อง">
            <label for="lab_number">หมายเลขห้อง</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="student_id" name="student_id" placeholder="รหัสนักศึกษา"
                autofocus>
            <label for="student_id">รหัสนักศึกษา</label>
        </div> --}}

    {{-- <a href="#" class="submit-data">Submit data</a> --}}

    {{-- <div id="exampleid"></div> --}}

    {{-- </form> --}}

    <form id="myForm">
        @csrf
        <input type="text" id="username" name="username" />
        <input type="email" id="email" name="email" />
        <button type="button" id="submitForm">Submit</button>
    </form>

    {{-- <button type="submit" class="btn btn-success">Submit</button> --}}

    {{-- {!! Form::close() !!} --}}

    {{-- <script>
    $(document).ready(function(){

    var form = '#add-booking';

    $(form).on('submit', function(event){
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $(form).trigger("reset");
                alert(response.success)
            },
            error: function(response) {
            }
        });
    });

});

</script> --}}

    {{-- <script>

    //$('.submit-data').click(function(e){
    $("#student_id").on('change', function(){
        $.ajax({
            method: "POST",
            url: "{{ url('reservations') }}",
            data: $( ":input" ).serialize() })
    });

</script> --}}


    <script>
        $(document).ready(function() {
            //       dd     $("#student_id").keypress(function() {
            $("#email").keypress(function() {
                var form = $("#myForm")[0]; // Get the form element
                var formData = new FormData(form); // Create a FormData object
                // formData.append('username', 'john_doe');
                // formData.append('email', 'john@example.com');
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "{{ route('reservations.store') }}", // Replace with your actual Laravel controller route
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("Data sent successfully", response);
                    },
                    error: function() {
                        console.error("Error sending data");
                    }
                });
            });
        });
    </script>

@endsection
