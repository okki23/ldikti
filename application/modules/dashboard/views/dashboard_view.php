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
                              Selamat Datang di Sistem Aplikasi Monitoring Jabatan

                            </h2>
                            <br>
                            
                        <div class="body">
                           
            	<div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   		 <div class="card">
                        <div class="header">
                            
                        </div>
                           
                        <div id="bar_a" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                           <!-- <canvas 
                            id="bar_chart_masuk" height="150"></canvas> -->

                        </div>
                </div>
                
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   		 <div class="card">
                        <div class="header">
                         
                             <?php
                             //echo $dataparse_div;
                             ?>
                             <div class="chart-container" id="chart"  style="min-width: 800px; height: 400px; margin: 0 auto"></div>


                        </div>
                         
                        </div>
                </div>


                

                </div>
                <div class="row clearfix">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                         <div class="card">
                        <div class="header">
                            <h2>  Map Formasi Jabatan </h2>
                            <button class="btn btn-primary" onclick="takescreenshot();"> Download This Map </button>
                        </div>
                                
                      <div id="capture_segment">
                             <div class="container-fluid" style="max-width: 100%; min-height: 200px;">
      
                            <?php
                            echo $dataparse;
                            ?>
                            <div id="chart-container-new" style="border:1px solid #999; padding:10px; border-radius:8px;"></div>
     
    </div>
</div>
                        </div>
                </div>
                </div>
          
                
            </div>

 
                        
                              
                        </div>
                    </div>
                </div>
            </div>
         


        </div>
</section>

<style type="text/css">
    #chart, #chart-advanced, #chart-3d {
        height: 400px; width: 100%; position: relative; 
    }
    #absolute_div{
        background-color: #fff;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #fff;
        padding: 5px 5px 5px 5px;
        width: 100%;
        min-height: 50px;
        overflow:hidden;
        word-wrap:break-word;
    }


</style>
<script src="http://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript" src="<?php echo base_url('assets/'); ?>grouped-categories.js"></script>

<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/'); ?>html2canvas.js"></script>
 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('assets/orgchart/'); ?>org_new.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/'); ?>css_chart.css">
<script type="text/javascript" src="<?php echo base_url('assets/orgchart/'); ?>org.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/orgchart/'); ?>orgExtras.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/orgchart/'); ?>scripts.js"></script>
<!-- 
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>jquery.orgchart.css">
<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>orgchart_style.css">
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>jquery.orgchart.js"></script> -->
 
 
<script>
        Highcharts.setOptions({
                chart: {
                        borderWidth: 10,
                        borderColor: '#e8eaeb',
                        borderRadius: 0,
                        backgroundColor: '#f7f7f7'
                },
                title: {
                        style: {
                                'fontSize': '1em'
                        },
                        useHTML: true,
                        x: -10,
                        y: 8,
                        text: ''
                }
        });
</script>  

<script>
 
function takescreenshot(){
    var element = $("#capture_segment");
    html2canvas(element,{
    background : '#FFFFFF',
        onrendered : function(canvas){
            var imgData = canvas.toDataURL('image/jpeg');
            $.ajax({
            url:'<?php echo base_url('dashboard/get_picture'); ?>',
            type:'post',
            dataType:'text',
            data:{
                base64data:imgData
            }
            });
        }
    });
}

//bagian chart

window.chart = new Highcharts.Chart({
    chart: {
        renderTo: "chart",
        type: "column"
    },
      title: {
        text: 'Pemenuhan Formasi Berdasarkan Divisi'
    },
    series:
    [{
         name: 'Jumlah Persentase Formasi Terisi',
    <?php
        $data_div = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from m_formasi_jabatan a
                             LEFT JOIN m_karyawan b on b.id = a.id_karyawan
                            LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                            LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
                            LEFT JOIN m_seksi e on e.id = a.id_seksi
                            LEFT JOIN m_divisi f on f.id = a.id_divisi 
                            where a.id_departemen = 0 and a.id_divisi != 0")->result();
            $return = [];
            foreach ($data_div as $key => $value) {
                $data['name'] = $value->nama_divisi;
             
                     $sqlb = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,
                                        d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from 
                                        m_formasi_jabatan a
                                       LEFT JOIN m_karyawan b on b.id = a.id_karyawan
                                        LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                                        LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
                                        LEFT JOIN m_seksi e on e.id = a.id_seksi
                                        LEFT JOIN m_divisi f on f.id = a.id_divisi 
                                        where a.id_divisi = '".$value->id_divisi."'
                                        GROUP BY c.id_kelas_jabatan")->result();
                     $listing = array();
                     foreach ($sqlb as $keyz => $valuez) {
                     $sql_all = $this->db->query("select a.* from m_formasi_jabatan a 
                        left join m_divisi b on b.id = a.id_divisi
                        left join m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                        left join m_kelas_jabatan d on d.id = c.id_kelas_jabatan where a.id_divisi = '".$value->id_divisi."' and d.nama_kelas_jabatan = '".$valuez->nama_kelas_jabatan."' ")->num_rows();
                        $sql_full = $this->db->query("select a.* from m_formasi_jabatan a 
                        left join m_divisi b on b.id = a.id_divisi
                        left join m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                        left join m_kelas_jabatan d on d.id = c.id_kelas_jabatan where a.id_divisi = '".$value->id_divisi."' and d.nama_kelas_jabatan = '".$valuez->nama_kelas_jabatan."' and a.id_karyawan != '' ")->num_rows();
                        $return[] = round($sql_full/$sql_all,1)*100;
                     }
                     
            }
            $databars = json_encode($return);
        ?>
        data: <?php echo $databars; ?>
    }],
   
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: 'Terisi: {point.y} %'
    },
    yAxis:  {
        min: 0,
        title: {
            text: 'Persentase'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    credits: {
      enabled: false
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            pointPadding: 0,
            groupPadding: 0,
            dataLabels: {
                enabled: true,
                color: '#FFFFFF'
            }
        }
    },

    xAxis: {
            <?php
            $data_div = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from m_formasi_jabatan a
                            LEFT JOIN m_karyawan b on b.id = a.id_karyawan
                            LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                            LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
                            LEFT JOIN m_seksi e on e.id = a.id_seksi
                            LEFT JOIN m_divisi f on f.id = a.id_divisi 
                            where a.id_departemen = 0 and a.id_divisi != 0")->result();
            $return = [];
            foreach ($data_div as $key => $value) {
                $data['name'] = $value->nama_divisi;
             
                     $sqlb = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,
                                        d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from 
                                        m_formasi_jabatan a
                                        LEFT JOIN m_karyawan b on b.id = a.id_karyawan
                                        LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
                                        LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
                                        LEFT JOIN m_seksi e on e.id = a.id_seksi
                                        LEFT JOIN m_divisi f on f.id = a.id_divisi 
                                        where a.id_divisi = '".$value->id_divisi."'
                                        GROUP BY c.id_kelas_jabatan")->result();
                     $listing = array();
                     foreach ($sqlb as $keyz => $valuez) {
                        $listing[] = $valuez->nama_kelas_jabatan;
                        
                     }
 
                $return_arr = ["name" => $value->nama_divisi,
                               "categories" => $listing,];
                $return[] = $return_arr;
                
            }
                
            
         ?>
     categories : <?php echo json_encode($return); ?>

    }
});
</script>
 
<script type="text/javascript">
     
	  
   $(function () {
 
   $('#bar_a').highcharts({
        chart: {
        type: 'column'
    },
    title: {
        text: 'Pemenuhan Formasi Berdasarkan Kelompok Jabatan'
    },
    xAxis: {
        categories:  <?php echo $datacat; ?>,
    }, 
      credits: {
      enabled: false
  },
    yAxis: {
        min: 0,
        title: {
            text: 'Persentase'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}  </b><br/>',
        pointFormat: '{series.name}: {point.y} % <br/>Total: {point.stackTotal} %'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
        series : [{
            name: 'Kosong',
            data: <?php echo $datakosong; ?>,
            color: '#0000FF',
        },{
          name: 'Terisi',
          data: <?php echo $dataisi; ?>,
          color: '#FF8C00',
      }]
                
            });
        });
</script>
 