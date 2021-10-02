@extends('templates.master',['judul' => 'Covid - Global'])

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md">
                <div class="card-body shadow rounded mb-3 mt-4" role="alert">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px;">
                        <path d="M15 0C6.72 0 0 6.72 0 15C0 23.28 6.72 30 15 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 15 0ZM16.5 22.5H13.5V13.5H16.5V22.5ZM16.5 10.5H13.5V7.5H16.5V10.5Z" fill="#FFA51F" />
                      </svg> &nbsp;
                      <b> Info COVID-19 Global </b>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <img src="{{url('dist/img/sad.svg')}}" style="width: 80px;float:right" alt="">
              <h3><?= $positif['value'] ?></h3>
              <p>Total Positif</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <img src="{{url('dist/img/happy.svg')}}" style="width: 80px;float:right" alt="">
              <h3><?= $sembuh['value'] ?></h3>
              <p>Total Sembuh</p>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-12">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <img src="{{url('dist/img/cry.svg')}}" style="width: 80px;float:right" alt="">
              <h3><?= $meninggal['value'] ?></h3>
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

        <!-- /.card -->
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mt-3">
          <div class="card-header bg-primary">
            <h3 class="card-title">Data Kasus covid-19 Global</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Negara</th>
                  <th>Positif</th>
                  <th>Sembuh</th>
                  <th>Meninggal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($global as $globals) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $globals['attributes']['Country_Region'] ?></td>
                    <td><?= number_format($globals['attributes']['Confirmed'], 0) ?></td>
                    <td><?= number_format($globals['attributes']['Recovered'], 0) ?></td>
                    <td><?= number_format($globals['attributes']['Deaths'], 0) ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Pemetaan Kasus covid-19 Global</h3>
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
    var mymap = L.map('mapid').setView([18.795412687718173, 88.39782382998932], 1.3);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
    }).addTo(mymap);
    
    @foreach($global as $value)
    L.marker([{{$value['attributes']['Lat']}}, {{$value['attributes']['Long_']}}]).addTo(mymap)
      .bindPopup("Negara : {{$value['attributes']['Country_Region']}}<br>" +
        "Positif : {{$value['attributes']['Confirmed']}}<br>" +
        "Sembuh : {{$value['attributes']['Recovered']}}<br>" +
        "Meninggal : {{$value['attributes']['Deaths']}}"
      ).openPopup();
    @endforeach
  </script>
@endsection