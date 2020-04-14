  <div id="page-wrapper">
    <div id="page-inner">
     <div class="col-xs-12">
      <div class="box box-info" style="background-color: #f8b500; text-shadow:0px 0px 4px white ;">
        <div class="box-warning" style="text-align: center">
          <h2 style="font-size: 30px;  font-family:'Nigbor Bold'; text-shadow: 1px 1px 1px black" ><b>PENCARIAN BERKAS KASUS FORENSIK</b></h2>
        </div>
        <div class="box-body no-padding">

          <div class="row">
            <div class="col-md-12">
             <div class="form-group ">
              <input type="text" name="search" id="search" class="form-control" placeholder="Pencarian...." autocomplete="off">
            </div>
          </div>
        </div>
        <br>
        <div id="pencarian" class="hidden" style="width: 98.5%; position: absolute; background-color: white; padding: 10px; top: 70%; right: 1; z-index: 9999; overflow-y: scroll;">
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>

 
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?php echo base_url("admin/data/arsip/diterima") ?>"><b>PERMOHONAN DITERIMA</b></a></span>
        <span class="info-box-number" style="font-size: 40px "><?php echo count($diterima) ?></span>
      </div>
    </div>
  </div>
   <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">
          <?php if ($this->session->has_userdata('admin')): ?>
            <b style="color: #284f96;">PERMOHONAN PENDING</b>
            <?php else: ?>
            <a href="<?php echo base_url("admin/data/permohonan") ?>"><b>PERMOHONAN PENDING</b></a>
          <?php endif ?>
        </span>
        <span class="info-box-number" style="font-size: 40px "><?php echo count($pending) ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-trash-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text"><a href="<?php echo base_url("admin/data/arsip/tidak_diterima") ?>"><b>PERMOHONAN TIDAK DITERIMA</b></a></span>
        <span class="info-box-number" style="font-size: 40px "><?php echo count($tidak_diterima) ?></span>
      </div>
    </div>
  </div>
  <div class="col-xs-12" style="padding-bottom: 30px">
    <div id="container"></div>
  </div>
  <div>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header"">
          <h3 class="box-title"><b> 5 Permohonan Terbaru</b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

          <table class="table table-hover">
            <tbody><tr class="text-center">
              <th>No Permohonan</th>
              <th>User</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Judul Permohoan</th>
            </tr>
            <?php foreach ($permohonan as $value): ?>
              <tr>
                <td><?php echo $value['nomor_permohonan']; ?></td>
                <td><?php echo $value['nama_klien']; ?></td>
                <td><?php echo date("d/m/Y",strtotime($value['tgl_permohonan'])); ?></td>
                <td>
                  <?php if ($value['status_permohonan']=="Diterima"): ?>
                    <span class="label label-success">Diterima</span>
                    <?php elseif($value['status_permohonan']=="Tidak Diterima"): ?>
                      <span class="label label-danger">Tidak Diterima</span>
                      <?php else: ?>
                        <span class="label label-warning">Pending</span>
                      <?php endif ?>
                    </td>
                    <td><?php echo $value['judul_permohonan']; ?></td>
                  </tr>
                <?php endforeach ?>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>

  </div>
</div>
</div>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
<?php $hasil = jumlah_permohonan(); ?>
<script >
  // Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
['id-3700', 0],
<?php foreach ($hasil as $key => $value): ?>
  ['<?php echo $key ?>',<?php echo $value['jumlah'] ?>],
<?php endforeach ?>
];

// Create the chart
Highcharts.mapChart('container', {
  chart: {
    map: 'countries/id/id-all'
  },

  title: {
    text: 'Provinsi Klien Laboratorium Forensika Digital UII'
  },

  subtitle: {
    text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
  },

  mapNavigation: {
    enabled: true,
    buttonOptions: {
      verticalAlign: 'bottom'
    }
  },

  colorAxis: {
    min: 0
  },

  series: [{
    data: data,
    name: 'Random data',
    states: {
      hover: {
        color: '#BADA55'
      }
    },
    dataLabels: {
      enabled: true,
      format: '{point.name}'
    }
  }]
});

</script>

