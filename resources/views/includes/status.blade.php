@php use Illuminate\Support\Facades\Session; @endphp
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
        {{ Session::forget('status') }}
    </div>
@endif

@if (Session::has('destroy_category'))
    <script type="text/javascript">
        swal({
            title: "Good job!",
            text: "{{ session('destroy_category') }}",
            icon: "success",
        });
    </script>
@endif
