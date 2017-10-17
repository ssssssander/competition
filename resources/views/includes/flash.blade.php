@if (session()->has('success'))
    <div class="alert alert-success alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      {!! session('success') !!}
    </div>
@endif
