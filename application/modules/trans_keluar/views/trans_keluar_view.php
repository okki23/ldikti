 <section class="content">
     <div class="container-fluid">
         <div class="block-header">

         </div>
         <!-- Basic Examples -->
         <div class="row clearfix">
             <div class="col-lg-12">
                 <div class="card">
                     <div class="header">
                         <h2>
                             Manajemen Surat Keluar
                         </h2>
                         <br> 
                         <a href="javascript:void(0);" id="addmodal" class="btn btn-primary waves-effect"> <i class="material-icons">add_circle</i> Tambah Data </a>

                     </div>
                     <div class="body"> 
                         <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover js-basic-example" id="example">
                                <thead>
                                     <tr>
                                         <th style="width:5%;">No Surat</th>
                                         <th style="width:5%;">Tanggal Keluar</th>
                                         <th style="width:5%;">Jenis Surat</th> 
                                         <th style="width:15%;">Opsi</th>
                                    </tr>
                                 </thead>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>



     </div>
 </section>


 <!-- form tambah dan ubah data -->
 <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="defaultModalLabel">Form Tambah Data</h4>
             </div>
             <div class="modal-body">
                 <form method="post" id="trans_keluar_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-line">
                            <label> No Surat </label>
                            <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="No Surat" required readonly="readonly" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="form-line">
                            <label> Tanggal Masuk </label>
                            <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="datepicker form-control"  />
                        </div>
                    </div> 
                    <div class="input-group">
                         <div class="form-line">
                             <input type="text" name="jenis_surat" id="jenis_surat" class="form-control" required readonly="readonly">
                             <input type="hidden" name="id_jenis_surat" id="id_jenis_surat" required readonly="readonly">

                         </div>
                         <span class="input-group-addon">
                             <button type="button" onclick="CariJenisSurat();" class="btn btn-primary"> Pilih Jenis Surat ... </button>
                         </span>
                     </div>
                    
                    <div class="input-group">
                         <div class="form-line">
                             <input type="text" name="nama" id="nama" class="form-control" required readonly="readonly">
                             <input type="hidden" name="disposisi" id="disposisi" required readonly="readonly">

                         </div>
                         <span class="input-group-addon">
                             <button type="button" onclick="CariPegawai();" class="btn btn-primary"> Disposisi ... </button>
                         </span>
                     </div>

                     <div class="form-group">
                        <div class="form-line">
                            <label> File Surat Masuk </label> 
                            <div id="suratx"> </div>
						   <!--kalo di klik ngambil file detail -->
						   <input type="file" name="filex" id="filex" onchange="PreviewFile(this);" />
						   <!--nampilin filename -->
						   <input type="hidden" name="file" id="file">
						   <br />
						   <button class="btn btn-primary" type="button" name="upload" id="upload" > Upload </button>
						   <br>
                        </div>
                    </div> 
					<hr>
					<div class="progress">
						<div class="progress-bar progress-bar-primary myprogress" role="progressbar" style="width:0%">0%</div>
					</div>
				 
                    <br>
                     <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                     <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form_Order();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                     <button type="button" name="cancelubah" id="cancelubah" class="btn btn-danger waves-effect" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                 </form>
             </div>

         </div>
     </div>
 </div>


 <!-- modal cari pegawai -->
 <div class="modal fade" id="CariPegawaiModal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Cari Pegawai</h4>
             </div>
             <div class="modal-body">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                 <br>
                 <hr>

                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_pegawai">

                     <thead>
                         <tr>
                             <th style="width:98%;">Nama Pegawai </th>
                             <th style="width:98%;">Jabatan</th>
                             <th style="width:98%;">Eselon </th>
                         </tr>
                     </thead>
                     <tbody id="daftar_pegawaix">

                     </tbody>
                 </table>
             </div>

         </div>
     </div>
 </div>

 
 <!-- modal cari jenis surat -->
 <div class="modal fade" id="CariJenisSuratModal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Cari Jenis Surat</h4>
             </div>
             <div class="modal-body">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                 <br>
                 <hr>

                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_surat">

                     <thead>
                         <tr>
                             <th style="width:98%;">Jenis Surat </th> 
                         </tr>
                     </thead>
                     <tbody id="daftar_suratx">

                     </tbody>
                 </table>
             </div>

         </div>
     </div>
 </div>


	<!-- detail data -->
	<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Surat Masuk</h4>
                        </div>
                        <div class="modal-body">

                        <div class="row clearfix">

                        <div class="col-lg-12">
            
                            <table class="table table-responsive">
                            <tr>
                                <td style="font-weight:bold;"> No Surat</td>
                                <td> : </td>
                                <td> <p id="no_suratdtl"> </p> </td>
                                
                                <td style="font-weight:bold;"> Tanggal Masuk</td>
                                <td> : </td>
                                <td> <p id="tgl_masukdtl"> </p> </td> 
                            </tr>
                            
                            <tr>
                                <td style="font-weight:bold;"> Jenis Surat</td>
                                <td> : </td>
                                <td> <p id="jenis_suratdtl"> </p> </td>
                                
                                <td style="font-weight:bold;"> Disposisi</td>
                                <td> : </td>
                                <td> <p id="disposisidtl"> </p> </td> 
                            </tr> 
                            
                            <tr>
                                <td style="font-weight:bold;"> PIC  </td> 
                                <td> : </td>
                                <td> <p id="picdtl"> </p> </td>
                                <td style="font-weight:bold;"> Berkas</td>
                                <td> : </td>
                                <td> <p id="berkasdtl"> </p> </td>
                            </tr> 
                             
                            </table> 
  
                        </div> 
							<div class="modal-footer">
							  <button type="button" class="btn btn-danger" data-dismiss="modal"> X Tutup </button>
							</div>
					
                           
					   </div>
                     
                    </div>
                </div>
    </div>
            

 
<script> 
$('.myprogress').css('width', '0');
$('.msg').text('');
function PreviewFile(input) {
		//kalo ada file di inputan maka buat proses
        if (input.files && input.files[0]){
            var reader = new FileReader(); //buat baca isi inputan file
            reader.onload = function (e) { //load isi dari inputan
				//parsing isi dari inputan ke dalam text sasaran
                $("#file").val($('#filex').val().replace(/C:\\fakepath\\/i, ''));
            };
            reader.readAsDataURL(input.files[0]); 
        }
}
$("#upload").on("click",function(){ 
	var file_data = $("#filex").prop("files")[0];   // Getting the properties of file from file field
	var form_data = new FormData();  
	form_data.append("file", file_data);
	 
	$('.msg').html('Uploading in progress...');
	$('#upload').attr('disabled', 'disabled');
	$.ajax({
		url: "<?php echo base_url('trans_keluar/saveupload'); ?>",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         // Setting the data attribute of ajax with file_data
        type: 'post',
		// this part is progress bar
        xhr: function () {
			
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
					$('.myprogress').text(percentComplete + '%');
					$('.myprogress').css('width', percentComplete + '%');
				}
            }, false); 
            return xhr; 
		},
		success:function(result){ 
			var parse = JSON.parse(result); 
			$('.msg').html('Upload Complete!');	
			$('#upload').prop('disabled', false);	  
			$(':input').val(''); 
		}

	});
 
}); 
</script>

 <script type="text/javascript"> 

     function Ubah_Data(id) {
         $("#defaultModalLabel").html("Form Ubah Data");
         $("#cancelubah").show();
         $("#cancel").hide();
         $("#upload").prop("disabled",false);
         $("#defaultModal").modal('show');
         
         $.ajax({
             url: "<?php echo base_url(); ?>trans_keluar/get_data_edit/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(result) {
                 $("#defaultModal").modal('show'); 
                 $("#suratx").html("<br> <hr> File Sebelumnya : <a href='upload/"+result.file+"' target='_blank' class='btn btn-primary'> <i class='material-icons'>file_copy</i> "+result.file+" </a> <br> <hr>");
                 $("#id").val(result.id); 
                 $("#no_surat").val(result.no_surat);
                 $("#tanggal_masuk").val(result.tanggal_masuk);
                 $("#nama").val(result.disposisiname);
                 $("#disposisi").val(result.disposisi);
                 $("#id_jenis_surat").val(result.id_jenis_surat);
                 $("#jenis_surat").val(result.jenis_surat);
                 $("#file").val(result.file);

             }
         });
     }

    function Show_Detail(id){ 
		$("#DetailModal").modal({backdrop: 'static', keyboard: false,show:true});  
		$.ajax({
			 url:"<?php echo base_url(); ?>trans_keluar/get_data_edit/"+id,
			 type:"GET",
			 dataType:"JSON", 
			 success:function(result){   
                 $("#no_suratdtl").html(result.no_surat);
                 $("#picdtl").html(result.pic);
                 $("#tgl_masukdtl").html(result.tanggal_masuk); 
                 $("#jenis_suratdtl").html(result.jenis_surat); 
                 $("#disposisidtl").html(result.disposisinip+' - '+result.disposisiname +' - '+result.disposisijabatan+ ' - '+result.disposisieselon); 
                 $("#berkasdtl").html("<a href='upload/"+result.file+"' target='_blank' class='btn btn-primary btn-lg'> <i class='material-icons'>file_copy</i>File Surat </a>");
			 }
		 });
    }
     
     function Bersihkan_Form() {
         $(':input').val('');
         $('#trans_keluar_form')[0].reset();
     }


    //pegawai disposisi
    function CariPegawai() {
         $("#CariPegawaiModal").modal({
             backdrop: 'static',
             keyboard: false,
             show: true
         });
     }

     $('#daftar_pegawai').DataTable({
         "ajax": "<?php echo base_url(); ?>trans_keluar/fetch_pegawai"
     });

     var daftar_pegawai = $('#daftar_pegawai').DataTable();

     $('#daftar_pegawai tbody').on('click', 'tr', function() {

         var content = daftar_pegawai.row(this).data()
         console.log(content);
         $("#nama").val(content[0]);
         $("#disposisi").val(content[3]);
         $("#CariPegawaiModal").modal('hide');
     });
    //pegawai disposisi

    //jenis surat

    function CariJenisSurat() {
         $("#CariJenisSuratModal").modal({
             backdrop: 'static',
             keyboard: false,
             show: true
         });
     }

     $('#daftar_surat').DataTable({
         "ajax": "<?php echo base_url(); ?>trans_keluar/fetch_jenis_surat"
     });

     var daftar_surat = $('#daftar_surat').DataTable();

     $('#daftar_surat tbody').on('click', 'tr', function() {

         var content = daftar_surat.row(this).data()
         console.log(content);
         $("#jenis_surat").val(content[0]);
         $("#id_jenis_surat").val(content[1]);
         $("#CariJenisSuratModal").modal('hide');
     });
 

    //jenis surat


     function Hapus_Data(id) {
         if (confirm('Anda yakin ingin menghapus data ini?')) {
             // ajax delete data to database
             $.ajax({
                 url: "<?php echo base_url('trans_keluar/hapus_data') ?>/" + id,
                 type: "GET",
                 dataType: "JSON",
                 success: function(data) {

                     $('#example').DataTable().ajax.reload();

                     $.notify("Data berhasil dihapus!", {
                         animate: {
                             enter: 'animated fadeInRight',
                             exit: 'animated fadeOutRight'
                         }
                     }, {
                         type: 'success'
                     });

                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     alert('Error deleting data');
                 }
             });

         }
     } 

     function Simpan_Data() {
         //setting semua data dalam form dijadikan 1 variabel 
         var formData = new FormData($('#trans_keluar_form')[0]);  
         var tanggal_masuk = $("#tanggal_masuk").val();
         var jenis_surat = $("#jenis_surat").val();
         var nama = $("#nama").val();

         if(tanggal_masuk == ''){
            alert('tanggal surat masuk belum ditentukan!'); 
         }else if(jenis_surat == ''){   
            alert('jenis surat masuk belum ditentukan!'); 
         }else if(nama == ''){
            alert('disposisi surat masuk belum ditentukan!'); 
         }else{

            $.ajax({
                 url: "<?php echo base_url(); ?>trans_keluar/simpan_data_trans_keluar",
                 type: "POST",
                 data: formData,
                 contentType: false,
                 processData: false,
                 success: function(result) {

                     $("#defaultModal").modal('hide');
                     $('#example').DataTable().ajax.reload();
                     $('#trans_keluar_form')[0].reset();
                     $('.myprogress').text('0%');
					 $('.myprogress').css('width', 0 + '%');

                     $.notify("Data berhasil disimpan!", {
                         animate: {
                             enter: 'animated fadeInRight',
                             exit: 'animated fadeOutRight'
                         }
                     }, {
                         type: 'success'
                     });
                 }
             });
         }

            
     }


     $('.datepicker').bootstrapMaterialDatePicker({
         format: 'YYYY-MM-DD',
         clearButton: true,
         weekStart: 1,
         time: false
     });


     $(document).ready(function() {
 
        $("#addmodal").on("click", function() {
                Bersihkan_Form(); 
                $("#suratx").html('');
                $("#cancelubah").hide();
                $("#cancel").show(); 
                $("#upload").prop("disabled",false);
                $("#defaultModal").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                }); 
                $.ajax({
                    url:"<?php echo base_url('trans_keluar/get_last_id'); ?>",
                    type:"GET",
                    data:{id:1},
                    success:function(result){ 
                        $("#no_surat").val(result); 
                    } 
                });  
             $("#defaultModalLabel").html("Form Tambah Data");
        });


         $('#example').DataTable({
             "ajax": "<?php echo base_url(); ?>trans_keluar/fetch_trans_keluar",
             "destroy":true
         }); 

     });
     function Bersihkan_Form_Order(){
        
        var no_surat = $("#no_surat").val(); 
        var r = confirm("Anda yakin ingin membatalkan transaksi ini? ini akan membatalkan transaksi "+no_surat+" !");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('trans_keluar/'); ?>hapus_no_surat",
                data: {no_surat:$("#no_surat").val()},
                success: function(data){
                    console.log(data);
                    $("#defaultModal").modal('hide');
                    $(':input').val('');  
                    $('#example').DataTable().ajax.reload();
                }

            }); 
        } else {
            alert("Transaksi tetap dilanjutkan"); 
        } 
       
    }
  
    function CariPegawai() {
         $("#CariPegawaiModal").modal({
             backdrop: 'static',
             keyboard: false,
             show: true
         });
    }

     $('#daftar_pegawai').DataTable({
         "ajax": "<?php echo base_url(); ?>user/fetch_pegawai",
         "destroy":true 
     });

     var daftar_pegawai = $('#daftar_pegawai').DataTable();

     $('#daftar_pegawai tbody').on('click', 'tr', function() {

         var content = daftar_pegawai.row(this).data()
         console.log(content);
         $("#nama").val(content[0]);
         $("#id_pegawai").val(content[3]);
         $("#CariPegawaiModal").modal('hide');
     });
 </script>