@if(Session::has('deleted'))
    <div class="alert alert-danger">{{session('deleted')}}</div>
@endif
@if(Session::has('created'))
    <div class="alert alert-success">{{session('created')}}</div>
@endif
@if(Session::has('edited'))
    <div class="alert alert-info">{{session('edited')}}</div>
@endif