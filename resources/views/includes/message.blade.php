@if (session()->has('message'))
    <div class="alert alert-{{ session('message-type') }} alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      {!! session('message') !!}
    </div>
@endif
