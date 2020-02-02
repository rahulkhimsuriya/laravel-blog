@if (session('success'))
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  </div>
</div>
@endif

@if (session('error'))
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  </div>
</div>
@endif