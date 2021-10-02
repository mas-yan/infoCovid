@extends('templates.master',['judul' => 'Covid - Kendal'])

@section('content')
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="card-body shadow rounded mb-3 mt-4" role="alert">
          <img src="{{url('dist/img/indonesia.svg')}}" width="30" height="30">
          <b> Info COVID-19 Kendal </b>
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
      <div class="col-md-4 col-sm-6 col-12">
        <!-- small box -->
        <div style="height: 150px;" class="alert alert-danger border border-danger">
          <div class="inner">
            <img src="{{url('dist/img/sad.svg')}}" style="width: 80px;float:right" alt="">
            <span class="font-weight-bold">Terkonfirmasi : Dirawat (Kasus Aktif)</span>
            <h5>{{$kendal['total']['konfirmasi']['dirawat'] }}</h5>
            <small class="text-dark">
              Pasien terkonfirmasi COVID-19 yang dirawat di RS atau isolasi mandiri
            </small>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-4 col-sm-6 col-12">
        <!-- small box -->
        <div style="height: 150px;" class="alert alert-success border border-success">
          <div class="inner">
            <img src="{{url('dist/img/happy.svg')}}" style="width: 80px;float:right" alt="">
            <span class="font-weight-bold">Terkonfirmasi : Sembuh</span>
            <h5>{{$kendal['total']['konfirmasi']['sembuh'] }}</h5>
            <small class="text-dark">
              Pasien terkonfirmasi COVID-19 yang sembuh atau selesai isolasi mandiri
            </small>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-4 col-sm-6 col-12">
        <!-- small box -->
        <div style="height: 150px;" class="alert alert-secondary border border-secondary">
          <div class="inner">
            <img src="{{url('dist/img/cry.svg')}}" style="width: 80px;float:right" alt="">
            <span class="font-weight-bold">Terkonfirmasi : Meninggal</span>
            <h5>{{$kendal['total']['konfirmasi']['meninggal'] }}</h5>
            <small class="text-dark">
              Pasien terkonfirmasi COVID-19 yang meninggal dunia
            </small>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div style="height: 150px;" class="alert alert-primary border border-primary">
          <div class="inner">
            <img src="{{url('dist/img/icon.svg')}}" style="width: 80px;float:right" alt="">
            <span class="font-weight-bold">Total Terkonfirmasi</span>
            <h5>{{$kendal['total']['konfirmasi']['total'] }}</h5>
            <small class="text-dark">
              Hasil penjumlahan angka dirawat, sembuh, dan meninggal
            </small>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="alert alert-warning border border-warning">
          <div class="inner">
            <img src="{{url('dist/img/sick.png')}}" style="width: 80px;float:right" alt="">
            <span class="font-weight-bold">Suspek</span>
            <h5>{{$kendal['total']['suspek'] }}</h5>
            <small class="text-dark">
              Orang dengan riwayat dari negara/wilayah transmisi lokal, dengan atau tanpa gejala/ menyerupai COVID-19 dan perlu perawatan RS (belum dinyatakan terkonfirmasi dengan SWAB test)
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-lg-12">
        <!-- /.card -->
        <div class="alert alert-danger">
          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: -5px;">
            <path d="M15 0C6.72 0 0 6.72 0 15C0 23.28 6.72 30 15 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 15 0ZM16.5 22.5H13.5V13.5H16.5V22.5ZM16.5 10.5H13.5V7.5H16.5V10.5Z" fill="#FFA51F" />
          </svg> &nbsp;Terakir Update {{$kendal['last_update'] }} WIB *(Data dapat berubah sewaktu-waktu)
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
            <h3 class="card-title">Data Kasus covid-19 Kendal</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th class="text-warning">Puskesmas</th>
                  <th class="text-primary">Pelaku Perjalanan</th>
                  <th class="text-danger">Kontak Erat</small>
                  </th>
                  <th class="text-success">Kasusu Probable</th>
                  <th class="text-info">Kasusu Suspek</th>
                  <th class="text-muted">Kasusu Konfirmasi</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($kendal["data"] as $result)
                  <tr>
                    <td>{{$no++ }}</td>
                    <td>{{$result['puskesmas'] }}</td>
                    <td>{{$result['perjalanan'] }}</td>
                    <td>{{$result['kontak'] }}</td>
                    <td>{{$result['probable'] }}</td>
                    <td>{{$result['suspek'] }}</td>
                    <td>{{$result['konfirmasi'] }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Sumber Data <a href="https://corona.kendalkab.go.id/">Pemerintah Kabupaten Kendal</a>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title">Pemetaan Kasus covid-19 Kendal</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <iframe frameborder="0" marginheight="0" marginwidth="0" title="Data Visualization" allowtransparency="true" allowfullscreen="true" class="tableauViz" style="display: block; width: 100%; height: 700px; margin: 0px; padding: 0px; border: none;" src="https://peta.kendalkab.go.id/Front/dinkes/" __idm_frm__="3203"></iframe>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Sumber Data <a href="https://corona.kendalkab.go.id/">Pemerintah Kabupaten Kendal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Main Footer -->
</div>
@endsection