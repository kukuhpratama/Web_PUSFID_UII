<footer style="text-align: center; height: 50px; color: white; background-color: #02386b; position: relative;" class="hidden-print">Copyright@PUSFID2018 </footer>


<script src=" <?php echo base_url("asset/js/bootstrap.min.js"); ?>"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url("asset/js/sendiri.js"); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#thetable').DataTable();
  } );
</script>

<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace("theeditor");
</script>

<script>
  $(document).ready(function(){
    $(document).on('keyup','#search',function(){
      var search = $(this).val();
      // alert(search);
      $.ajax({
        url:'<?php echo base_url("admin/welcome/cari_permohonan") ?>',
        method: "POST",
        data:'search='+search,
        success: function(data)
        {

          if(search=="")
          {
            $("#pencarian").addClass('hidden');

          }
          else
          {
           $("#pencarian").html(data);
           $("#pencarian").removeClass("hidden");
           
         }
       }
     })
    });
  });
  $(document).on('click',function(){
    $("#pencarian").addClass("hidden");
  })
</script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script >
  
// Build the chart
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Diagram Permohonan Masuk <?php echo $tahun; ?>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: false
      },
      showInLegend: true
    }
  },
  series: [{
    name: 'Permohonan',
    colorByPoint: true,
    data: [{
      name: 'Diterima',
      y: <?php echo $diterima['COUNT(id_permohonan)']; ?>,
      sliced: true
    }, {
      name: 'Tidak Diterima',
      y: <?php echo $tidak['COUNT(id_permohonan)']; ?>
    }]
  }]
});
</script>

<script >
  $(document).ready(function(){
    $(document).on("keyup",'#tambah',function(e){
      var banyak = $(this).val();
      if(banyak=="")
      {
        $("#inputan").empty().append();
      }
      else
      {
        for(var i=1;i<=banyak;i++)
        {
          $("#inputan").append('<div class="form-group"><label class="control-label col-sm-3">Foto Fisik Barang Bukti '+i+'<span style="color:red;">*</span></label><div class="col-sm-9"><input type="file"name="foto[]" required="required"><span style="color: black;">*File dengan Ekstensi (JPG,MP4,MP3) yang bisa di UPLOAD</span></div></div>');
        }
      }
      e.preventDefault();
    });
  })
</script>



</body>
</html>