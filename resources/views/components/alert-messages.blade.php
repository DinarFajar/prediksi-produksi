@props(['status' => null, 'messages' => null])

@if($status && $messages)
  @if($status === 'success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! $messages !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @elseif($status === 'fail')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! $messages !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
@endif

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if(session('fail'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {!! session('fail') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if(session('status'))
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    {!! session('status') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
