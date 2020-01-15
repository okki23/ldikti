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
                             Pegawai
                         </h2>
                         <br>
                         <a href="javascript:void(0);" id="addmodal" class="btn btn-primary waves-effect"> <i class="material-icons">add_circle</i> Tambah Data </a>

                     </div>
                     <div class="body">

                         <div class="table-responsive">
                             <table class="table table-bordered table-striped table-hover js-basic-example" id="example">
                                 <thead>
                                     <tr>
                                         <th style="width:5%;">No</th>
                                         <th style="width:5%;">NIP</th>
                                         <th style="width:5%;">Nama</th>
                                         <th style="width:5%;">Jabatan</th>
                                         <th style="width:5%;">Jenis Kelamin</th>
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
                 <form method="post" id="user_form" enctype="multipart/form-data">

                     <input type="hidden" name="id" id="id">
                     <!-- hidden -->
                     <div class="input-group">
                         <div class="form-line">
                             <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" required readonly="readonly">
                             <input type="hidden" name="id_jabatan" id="id_jabatan" required>

                         </div>
                         <span class="input-group-addon">
                             <button type="button" onclick="CariJabatan();" class="btn btn-primary"> Pilih Jabatan... </button>
                         </span>
                     </div>

                     <div class="form-group">
                         <div class="form-line">
                             <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP" />
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="form-line">
                             <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" />
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="form-line">
                             <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" />
                         </div>
                     </div>
                     <div class="form-group">

                         <label> Jenis Kelamin </label>
                         <br>
                         <input type="hidden" name="jk" id="jk">

                         <button type="button" id="lbtn" class="btn btn-default waves-effect "> Laki Laki </button>

                         <button type="button" id="pbtn" class="btn btn-default waves-effect "> Perempuan </button>

                     </div>
                     <div class="form-group">
                         <div class="form-line">
                             <input type="text" name="telp" id="telp" class="form-control" placeholder="Telp" />
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="form-line">
                             <input type="text" name="email" id="email" class="form-control" placeholder="Email" />
                         </div>
                     </div>
                     <button type="button" onclick="Simpan_Data();" class="btn btn-success waves-effect"> <i class="material-icons">save</i> Simpan</button>

                     <button type="button" name="cancel" id="cancel" class="btn btn-danger waves-effect" onclick="javascript:Bersihkan_Form();" data-dismiss="modal"> <i class="material-icons">clear</i> Batal</button>
                 </form>
             </div>

         </div>
     </div>
 </div>


 <!-- modal cari jabatan -->
 <div class="modal fade" id="CariJabatanModal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Cari Jabatan</h4>
             </div>
             <div class="modal-body">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                 <br>
                 <hr>

                 <table width="100%" class="table table-bordered table-striped table-hover " id="daftar_jabatan">

                     <thead>
                         <tr>
                             <th style="width:98%;">Jabatan</th>
                             <th style="width:98%;">Eselon </th>
                         </tr>
                     </thead>
                     <tbody id="daftar_jabatanx">

                     </tbody>
                 </table>
             </div>

         </div>
     </div>
 </div>


 <!-- modal detail -->
 <div class="modal fade" id="DetailModal" tabindex="-1" role="dialog">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Detail</h4>
             </div>
             <div class="modal-body">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">X Tutup</button>

                 <br>
                 <hr>

                 <table class="table table-bordered table-striped table-hover js-basic-example" id="examples">
                     <tr>
                         <td> NIP </td>
                         <td> : </td>
                         <td>
                             <p id="nip_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Nama </td>
                         <td> : </td>
                         <td>
                             <p id="nama_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Jabatan </td>
                         <td> : </td>
                         <td>
                             <p id="jabatan_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Eselon </td>
                         <td> : </td>
                         <td>
                             <p id="eselon_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Jenis Kelamin </td>
                         <td> : </td>
                         <td>
                             <p id="jk_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Alamat </td>
                         <td> : </td>
                         <td>
                             <p id="alamat_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Telp </td>
                         <td> : </td>
                         <td>
                             <p id="telp_p"> </p>
                         </td>
                     </tr>
                     <tr>
                         <td> Email </td>
                         <td> : </td>
                         <td>
                             <p id="email_p"> </p>
                         </td>
                     </tr>
                 </table>
             </div>

         </div>
     </div>
 </div>



 <script type="text/javascript">
     function CariJabatan() {
         $("#CariJabatanModal").modal({
             backdrop: 'static',
             keyboard: false,
             show: true
         });
     }
     $('#daftar_jabatan').DataTable({
         "ajax": "<?php echo base_url(); ?>pegawai/fetch_jabatan"
     });

     var daftar_jabatan = $('#daftar_jabatan').DataTable();

     $('#daftar_jabatan tbody').on('click', 'tr', function() {

         var content = daftar_jabatan.row(this).data()
         console.log(content);
         $("#nama_jabatan").val(content[0]);
         $("#id_jabatan").val(content[2]);
         $("#CariJabatanModal").modal('hide');
     });

     //kantor
     $("#lbtn").on("click", function() {
         $("#jk").val('L');
         $(this).attr('class', 'btn btn-primary');
         $("#pbtn").attr('class', 'btn btn-default');

     });

     $("#pbtn").on("click", function() {
         $("#jk").val('P');
         $(this).attr('class', 'btn btn-primary');
         $("#lbtn").attr('class', 'btn btn-default');


     });




     function Detail(id) {

         $.ajax({
             url: "<?php echo base_url(); ?>pegawai/get_data_edit/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(result) {

                 $("#DetailModal").modal('show');
                 $("#nip_p").html(result.nip);
                 $("#nama_p").html(result.nama);
                 $("#jabatan_p").html(result.nama_jabatan);
                 $("#eselon_p").html(result.eselon);
                 $("#jk_p").html(result.jk);
                 if (result.jk == 'L') {
                     $("#jk_p").html('Laki-Laki');
                 } else {
                     $("#jk_p").html('Perempuan');
                 }
                 $("#alamat_p").html(result.alamat);
                 $("#email_p").html(result.email);
                 $("#telp_p").html(result.telp);
             }
         });


     }






     function Ubah_Data(id) {
         $("#defaultModalLabel").html("Form Ubah Data");
         $("#defaultModal").modal('show');

         $.ajax({
             url: "<?php echo base_url(); ?>pegawai/get_data_edit/" + id,
             type: "GET",
             dataType: "JSON",
             success: function(result) {

                 $("#defaultModal").modal('show');
                 $("#id").val(result.id);
                 $("#nip").val(result.nip);
                 $("#id_jabatan").val(result.id_jabatan);
                 $("#nama").val(result.nama);
                 $("#nama_jabatan").val(result.nama_jabatan);
                 $("#eselon").val(result.eselon);
                 $("#alamat").val(result.alamat);
                 $("#telp").val(result.telp);
                 $("#jk").val(result.jk);
                 $("#email").val(result.email);

                 if (result.jk == 'L') {
                     $("#lbtn").attr('class', 'btn btn-primary');
                     $("#pbtn").attr('class', 'btn btn-default');
                 } else {
                     $("#pbtn").attr('class', 'btn btn-default');
                     $("#lbtn").attr('class', 'btn btn-primary');
                 }

             }
         });
     }

     function Bersihkan_Form() {
         $(':input').val('');

     }

     function Hapus_Data(id) {
         if (confirm('Anda yakin ingin menghapus data ini?')) {
             // ajax delete data to database
             $.ajax({
                 url: "<?php echo base_url('pegawai/hapus_data') ?>/" + id,
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
         var formData = new FormData($('#user_form')[0]);
         var nama_pegawai = $("#nama_pegawai").val();
         //transaksi dibelakang layar
         $.ajax({
             url: "<?php echo base_url(); ?>pegawai/simpan_data",
             type: "POST",
             data: formData,
             contentType: false,
             processData: false,
             success: function(result) {
                 $("#defaultModal").modal('hide');
                 $('#example').DataTable().ajax.reload();
                 $('#user_form')[0].reset();
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


     $(document).ready(function() {
         $("#addmodal").on("click", function() {
             $("#defaultModal").modal({
                 backdrop: 'static',
                 keyboard: false,
                 show: true
             });
             $("#method").val('Add');
             $("#defaultModalLabel").html("Form Tambah Data");
         });

         var groupColumn = 3;
         var table = $('#example').DataTable({
             "ajax": "<?php echo base_url(); ?>pegawai/fetch_pegawai",
             "columnDefs": [{
                 "visible": false,
                 "targets": groupColumn
             }],
             "order": [
                 [0, 'asc']
             ],
             "displayLength": 10,
             "drawCallback": function(settings) {
                 var api = this.api();
                 var rows = api.rows({
                     page: 'current'
                 }).nodes();
                 var last = null;

                 api.column(groupColumn, {
                     page: 'current'
                 }).data().each(function(group, i) {
                     if (last !== group) {
                         $(rows).eq(i).before(
                             '<tr class="group"><td colspan="5"><b>' + group + '</b></td></tr>'
                         );

                         last = group;
                     }
                 });
             }
         });

         // Order by the grouping
         $('#example tbody').on('click', 'tr.group', function() {
             var currentOrder = table.order()[0];
             if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                 table.order([groupColumn, 'asc']).draw();
             } else {
                 table.order([groupColumn, 'asc']).draw();
             }
         });


     });
 </script>