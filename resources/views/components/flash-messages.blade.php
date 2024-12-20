{{--@session('success')--}}
{{--<div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--    {{ $value }}--}}
{{--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--</div>--}}
{{--@endsession--}}

{{--@session('error')--}}
{{--<div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--    {{ $value }}--}}
{{--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--</div>--}}
{{--@endsession--}}

{{--@session('warning')--}}
{{--<div class="alert alert-warning alert-dismissible fade show" role="alert">--}}
{{--    {{ $value }}--}}
{{--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--</div>--}}
{{--@endsession--}}

{{--@session('info')--}}
{{--<div class="alert alert-info alert-dismissible fade show" role="alert">--}}
{{--    {{ $value }}--}}
{{--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--</div>--}}
{{--@endsession--}}

{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--        <strong>Please check the form below for errors</strong>--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--@endif--}}

<script defer>
    const onready = () => {
        @session('success')
            window.Toast.fire({
                icon: "success",
                title: "{{ $value }}"
            });
        @endsession

        @session('error')
            window.Toast.fire({
                icon: "error",
                title: "{{ $value }}"
            });
        @endsession

        @session('warning')
            window.Toast.fire({
                icon: "warning",
                title: "{{ $value }}"
            });
        @endsession

        @session('info')
            window.Toast.fire({
                icon: "info",
                title: "{{ $value }}"
            });
        @endsession

        @if ($errors->any())
        window.Toast.fire({
            icon: "error",
            title: "Please check the form below for errors"
        });
        @endif
    }

    document.addEventListener("DOMContentLoaded", onready)
</script>
