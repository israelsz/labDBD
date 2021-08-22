@if ($message = Session::get('loginCorrecto'))
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('loginError'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('editUserError'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('logout'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('register'))
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('registerError'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('noUsers'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('saldoRecargado'))
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('errorMonto'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif