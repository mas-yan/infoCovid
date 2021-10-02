@extends('templates.master',['judul' => 'Covid - Indonesia'])

@section('content')
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="card-body shadow rounded mb-3 mt-4" role="alert">
          <img src="{{url('dist/img/indonesia.svg')}}" width="30" height="30">
          <b> Info COVID-19 Indonesia </b>
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class=" content">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6 col-12">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <img src="{{url('dist/img/sick.png')}}" style="width: 80px;float:right">
            <h3>{{$indonesia['total']['dirawat'] }}</h3>
            <p>Terkonfirmasi : Dirawat</p>
          </div>
        </div>
      </div>

      <div class="col col-sm-6 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <img src="{{url('dist/img/happy.svg')}}" style="width: 80px;float:right">
            <h3>{{$indonesia['total']['sembuh'] }}</h3>
            <p>Total Sembuh</p>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col col-sm-6 col-12">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <img src="{{url('dist/img/sad.svg')}}" style="width: 80px;float:right">
            <h3>{{$indonesia['total']['positif'] }}</h3>
            <p>Total Positif</p>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col col-sm-6 col-12">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <img src="{{url('dist/img/cry.svg')}}" style="width: 80px;float:right">
            <h3>{{$indonesia['total']['meninggal'] }}</h3>
            <p>Terkonfirmasi : Meninggal</p>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="container mt-3">
  <div class="row">
    <div class="col-lg-12">
      <!-- /.card -->
      <div class="alert alert-danger">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px;">
          <path d="M15 0C6.72 0 0 6.72 0 15C0 23.28 6.72 30 15 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 15 0ZM16.5 22.5H13.5V13.5H16.5V22.5ZM16.5 10.5H13.5V7.5H16.5V10.5Z" fill="#FFA51F" />
        </svg> &nbsp;Terakir Update {{date("Y-m-d H:i:s", strtotime($indonesia['total']['lastUpdate'])) }} WIB
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="card mt-3">
        <div class="card-header bg-primary">
          <h3 class="card-title">Data Kasus covid-19 Indonesia</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Provinsi</th>
                <th>Kasus</th>
                <th>Dirawat</th>
                <th>Sembuh</th>
                <th>Meninggal</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
              @foreach ($provinsi as $data)
                <tr>
                  <td>{{$no++ }}</td>
                  <td>{{$data['provinsi'] }}</td>
                  <td>{{number_format($data['kasus'], 0) }}</td>
                  <td>{{number_format($data['dirawat'], 0) }}</td>
                  <td>{{number_format($data['sembuh'], 0) }}</td>
                  <td>{{number_format($data['meninggal'], 0) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card mt-3">
        <div class="card-header">
          <h3 class="card-title">Pemetaan Kasus covid-19 Indonesia</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div id="mapid" style="height: 400px;"></div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
      var mymap = L.map('mapid').setView([2.0741713407586007, 114.00905143921841], 3.5);

      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
          'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
      }).addTo(mymap);

    @foreach($provinsi as $value)
      L.marker([{{$value['lokasi']['lat'] }}, {{$value['lokasi']['lon'] }}]).addTo(mymap)
        .bindPopup("Provinsi : {{$value['provinsi']}}<br>" +
          "Kasus : {{$value['kasus']}}<br>" +
          "Sembuh : {{$value['sembuh']}}<br>" +
          "Meninggal : {{$value['meninggal']}}<br>" +
          "Dirawat : {{$value['dirawat']}}"
        ).openPopup();
    @endforeach
  </script>
@endsection