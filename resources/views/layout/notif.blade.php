@if ($message = Session::get('success'))
<div class="alert alert-success" role="alert">
    <strong class="text-capitalize">Success!</strong> {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
    <strong class="text-capitalize">Error!</strong> {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span></button>
</div>
@endif

