@if (session('status'))
    <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@endif
@if (session('dangerMsg'))
    <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
        <strong>{{ session('dangerMsg') }}</strong>
    </div>
@endif
