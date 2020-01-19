 <section class="content">
     <div class="container-fluid">
         <div class="block-header">

         </div>
         <!-- Basic Examples -->
         <div class="row clearfix">
             <div class="col-lg-12">
                 <div class="card">
                     <div class="header">  
                     </div>
                     <div class="body"> 
                     <form method="post" id="report_surat_keluar_form" enctype="multipart/form-data" action="<?php echo base_url('report_surat_keluar/process_report')?>" target="_blank">
                       <h2 align="center"> Cetak Laporan Surat Keluar </h2>
                        <div class="form-group">
                            <div class="form-line">
                                <label> Dari Tanggal </label>
                                <input type="text" name="from" id="from" required="required" class="datepicker form-control"  />
                            </div>
                        </div>  

                        <div class="form-group">
                            <div class="form-line">
                                <label> Ke Tanggal </label>
                                <input type="text" name="to" id="to" required="required" class="datepicker form-control"  />
                            </div>
                        </div>  
                    
                        <br>
                        <button type="submit" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Cetak Laporan</button>
                     </form>
                     </div>
                 </div>
             </div>
         </div>



     </div>
 </section> 

<script type="text/javascript">  
       
     function Simpan_Data() {
        window.open("<?php echo base_url('report_surat_keluar/save_report/')?>", "_blank"); 
         //setting semua data dalam form dijadikan 1 variabel 
         var formData = new FormData($('#report_surat_keluar_form')[0]);  
         var tanggal_masuk = $("#tanggal_masuk").val();
         var jenis_surat = $("#jenis_surat").val();
         var nama = $("#nama").val(); 
         var pengirim = $("#pengirim").val();
         var alamat_pengirim = $("#alamat_pengirim").val();
         var telp_pengirim= $("#telp_pengirim").val();

         if(tanggal_masuk == ''){
            alert('tanggal surat masuk belum ditentukan!'); 
         }else if(jenis_surat == ''){   
            alert('jenis surat masuk belum ditentukan!'); 
         }else if(nama == ''){
            alert('disposisi surat masuk belum ditentukan!'); 
        }else if(pengirim == ''){
            alert('pengirim surat masuk belum ditentukan!'); 
         }else if(alamat_pengirim == ''){   
            alert('alamat pengirim surat masuk belum ditentukan!'); 
         }else if(telp_pengirim == ''){
            alert('telp pengirim surat masuk belum ditentukan!');  
         }else{

            $.ajax({
                 url: "<?php echo base_url(); ?>report_surat_keluar/simpan_data_report_surat_keluar",
                 type: "POST",
                 data: formData,
                 contentType: false,
                 processData: false,
                 success: function(result) {

                     $("#defaultModal").modal('hide');
                     $('#example').DataTable().ajax.reload();
                     $('#report_surat_keluar_form')[0].reset();
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
 
 </script>