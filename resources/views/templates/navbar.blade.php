<!-- Navbar -->
<nav class="main-header navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="{{url('dist/img/icon.svg')}}" alt="" width="35px">
      Info Covid
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mb-1">
        <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="{{url('/')}}">Global</a>
        <a class="nav-link {{Request::is('indonesia*') ? 'active' : ''}}" href="{{url('/indonesia')}}">Indonesia</a>
        <a class="nav-link {{Request::is('jateng*') ? 'active' : ''}}" href="{{url('/jateng')}}">Jawa Tengah</a>
        <a class="nav-link {{Request::is('kendal*') ? 'active' : ''}}" href="{{url('/kendal')}}">Kendal</a>
      </div>
    </div>
  </div>
</nav>
<!-- /.navbar -->