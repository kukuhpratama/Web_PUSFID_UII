<div id="page-wrapper">
   <div class="box-header">
      <h3 class="box-title" style="font-size: 20px; opacity: 0.7; margin-left: 4px"><b>Data Report </b></h3>
    </div>

    <div id="page-inner">
      <div class="box box-info">
        <div class="box-body">
            <div class="col-md-6">
          <!-- DONUT CHART -->
          <?php if (empty($pengajuan)): ?>
            <div class="alert alert-warning" ><b><i class="fa fa-warning"></i> Tidak Ada Data Permohonan Di Bulan Ini</b></div>
            <?php else:?>
              <div class="box table-bordered">
                <div class="box-body">
                  <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                </div>
              </div>
            <?php endif ?>
          </div>

          <div class="col-md-6">
            <div class="box table-bordered">
              <br>
              <div class="box-body">
                <form method="POST">
                  <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun" class="form-control js-example-basic-single">
                      <option value="">- Pilih Tahun</option>
                      <?php for ($i=2000;$i<=date("Y");$i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                      <?php endfor ?>  
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Bulan</label>
                    <select name="bulan" class="form-control js-example-basic-single">
                      <option value="">- Pilih Bulan</option>
                      <?php foreach ($bulan as $key => $value): ?>
                        <option value="<?php echo $key+1 ?>"><?php echo $value ?></option>
                      <?php endforeach ?>  
                    </select>
                  </div>
                  <button class="btn btn-primary pull-right"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>