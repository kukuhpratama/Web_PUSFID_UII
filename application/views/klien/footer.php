<footer style="text-align: center; height: 50px; color: white; background-color: #02386b; position: relative;" class="hidden-print">Copyright@PUSFID2018	</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src=" <?php echo base_url("asset/js/bootstrap.min.js"); ?>"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#thetable').DataTable();
	} );
</script>

<script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace("theeditor");
</script>

<script src="<?php echo base_url("asset/js/sendiri.js"); ?>"></script>

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