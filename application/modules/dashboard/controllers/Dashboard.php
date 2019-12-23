<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 

class Dashboard extends Parent_Controller {
 

 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_dashboard');
 	}


	public function get_picture(){
		$data = $_REQUEST['base64data'];
	$image = explode('base64,',$data);
	file_put_contents('1.jpg',base64_decode($image[1]));

	}
	 


 public function databars(){

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
			echo json_encode($return);
  }

  public function testing(){
         
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
			echo json_encode($return);
            
    }
 	
 	public function get_list_terisi(){
 		$sql = $this->db->query("select a.*,b.nama_kelompok_jabatan,c.nama_kelas_jabatan from m_formasi_jabatan a
		 	left join m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
		 	left join m_kelas_jabatan c on c.id = b.id_kelas_jabatan
		 	where id_direktorat != 0 GROUP by c.id ORDER BY c.id ASC")->result();

	 	$res = array();
	 	$hasil = '';
		foreach ($sql as $key => $value) {

		 	//echo $value->nama_kelas_jabatan."<br>";
		 	$data['kel1all'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' ")->row();

		 	$data['kel1isi'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' and a.id_karyawan != '' ")->row();

		 	$data['kel1kosong'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' and a.id_karyawan = '' ")->row();
			$res[] = (($data['kel1isi']->total / $data['kel1all']->total)* 100);
 
		 }
		 //var_dump($res);
		 $hasil .= '['.implode(",", $res).']'; 
		 return $hasil;
 	}

 	public function get_list_kosong(){
 		$sql = $this->db->query("select a.*,b.nama_kelompok_jabatan,c.nama_kelas_jabatan from m_formasi_jabatan a
		 	left join m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
		 	left join m_kelas_jabatan c on c.id = b.id_kelas_jabatan
		 	where id_direktorat != 0 GROUP by c.id ORDER BY c.id ASC")->result();

	 	$res = array();
	 	$hasil = '';
		foreach ($sql as $key => $value) {

		 	//echo $value->nama_kelas_jabatan."<br>";
		 	$data['kel1all'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' ")->row();

		 	$data['kel1isi'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' and a.id_karyawan != '' ")->row();

		 	$data['kel1kosong'] = $this->db->query("SELECT count(a.id) as total from m_formasi_jabatan a
			LEFT JOIN m_kelompok_jabatan b on b.id = a.id_kelompok_jabatan
			LEFT JOIN m_kelas_jabatan c on c.id = b.id_kelas_jabatan
			where a.id_kelompok_jabatan = '".$value->id_kelompok_jabatan."' and a.id_karyawan = '' ")->row();
			$res[] = (($data['kel1kosong']->total / $data['kel1all']->total)* 100);
 
		 }
		 //var_dump($res);
		 //echo '['.implode(",", $res).']'; 
		 $hasil .=  '['.implode(",", $res).']'; 
		 return $hasil;
 	}

	public function index(){
		$get_categori = $this->db->query("select * from m_kelompok_jabatan")->result();
	 	foreach ($get_categori as $key => $value) {
	 		$list_cat[] = '"'.$value->nama_kelompok_jabatan.'"';
	 	}
	 	
		  
	  

		$data_div = $this->db->query("select * from m_divisi")->result();
		foreach ($data_div as $key => $value) {
	 		$list_div[] = '"'.$value->nama_divisi.'"';
	 	}
	  
	  
	 	$data['dataparsex'] = $this->formasi(0,"");
		$data['dataparse'] = $this->getmenus(0,"");
		$data['dataparse_div'] = '';
		 
		//$data['testing'] = $this->cobas();
		 
		// $data['datakosong'] = '['.implode(",", $kosong).']'; 
		// $data['dataisi'] = '['.implode(",", $terisi).']';

		$data['datakosong'] = $this->get_list_kosong();
		$data['dataisi'] = $this->get_list_terisi();

		$data['datacat'] = '['.implode(",", $list_cat).']';

		$data['datadiv'] = '['.implode(",", $list_div).']';
 	 
		$data['judul'] = $this->data['judul']; 
		$data['konten'] = 'dashboard/dashboard_view';

		$this->load->view('template_view',$data);
	}

	public function cobas(){
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
                echo json_encode($return);
            
	 		
	}
	 public function coba(){
	 	//header('Content-Type: application/json');
	 	$data_div = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from m_formasi_jabatan a
					      	LEFT JOIN m_karyawan b on b.id = a.id_karyawan
					      	LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
					      	LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
					      	LEFT JOIN m_seksi e on e.id = a.id_seksi
					      	LEFT JOIN m_divisi f on f.id = a.id_divisi 
					      	where a.id_departemen = 0 and a.id_divisi != 0")->result();
	 		foreach ($data_div as $key => $value) {
	 			echo $value->nama_divisi."<br>";

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
	 			foreach ($sqlb as $keyz => $valuez) {
	 				//echo $valuez->nama_kelas_jabatan."<br>";

	 				$sqlklas_all = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,
	 									d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from 
	 									m_formasi_jabatan a
								      	LEFT JOIN m_karyawan b on b.id = a.id_karyawan
								      	LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
								      	LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
								      	LEFT JOIN m_seksi e on e.id = a.id_seksi
								      	LEFT JOIN m_divisi f on f.id = a.id_divisi 
								      	where a.id_divisi = '".$valuez->id_divisi ."' and d.nama_kelas_jabatan = '".$valuez->nama_kelas_jabatan."'  ")->num_rows();
	 				$sqlklas_full = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,
	 									d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from 
	 									m_formasi_jabatan a
								      	LEFT JOIN m_karyawan b on b.id = a.id_karyawan
								      	LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
								      	LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
								      	LEFT JOIN m_seksi e on e.id = a.id_seksi
								      	LEFT JOIN m_divisi f on f.id = a.id_divisi 
								      	where a.id_divisi = '".$valuez->id_divisi ."' and d.nama_kelas_jabatan = '".$valuez->nama_kelas_jabatan."' and a.id_karyawan != '' ")->num_rows();

	 				$sqlklas_empty = $this->db->query("SELECT a.*,b.nama_karyawan,c.nama_kelompok_jabatan,
	 									d.nama_kelas_jabatan,e.nama_seksi,f.nama_divisi from 
	 									m_formasi_jabatan a
								      	LEFT JOIN m_karyawan b on b.id = a.id_karyawan
								      	LEFT JOIN m_kelompok_jabatan c on c.id = a.id_kelompok_jabatan
								      	LEFT JOIN m_kelas_jabatan d on d.id = c.id_kelas_jabatan
								      	LEFT JOIN m_seksi e on e.id = a.id_seksi
								      	LEFT JOIN m_divisi f on f.id = a.id_divisi 
								      	where a.id_divisi = '".$valuez->id_divisi ."' and d.nama_kelas_jabatan = '".$valuez->nama_kelas_jabatan."' and a.id_karyawan = '' ")->num_rows();
	 				echo " - Untuk Kelas ".$valuez->nama_kelas_jabatan. " Pada divisi ".$value->nama_divisi. " Semua : ".$sqlklas_all. " Kosong : ".$sqlklas_empty. " Terisi : ".$sqlklas_full."<br>";
	 			}

	 		}
			
		exit();
	   
	}
 
	public function resmenu(){
		echo $this->get_data(0);
	}

	public function get_data($induk=0){
	   $hasil = "<ul>";
	   $sql = $this->db->query("select a.*,b.nama_karyawan,b.foto from m_formasi_jabatan a left join m_karyawan b on b.id = a.id_karyawan where id_parent = '".$induk."' ");
	    
	 
	   foreach($sql->result() as $row)
	   {
	      $hasil .= "<li>".$row->nama_jabatan;
	      
	      $hasil .= $this->get_data($row->id);
	      
	      $hasil .= "</li>";
	         
	   }
	   $hasil .="</ul>";
	   return $hasil;
	   
	}
	 
	 function pgetmenu(){
	 	echo $this->formasi(0,"");
	 }

	  
     function formasi($parent,$hasil){
     	$sql = $this->db->query("select a.*,b.nama_karyawan,b.foto from m_formasi_jabatan a left join m_karyawan b on b.id = a.id_karyawan where id_parent = '".$parent."' ");

     	if(($sql->num_rows())>0){
            $hasil .= "<ul>"; 
        }

        foreach($sql->result() as $h){

        	if($h->foto == NULL || $h->foto == '' && $h->is_separator == 0){
        	$hasil.= "<li> <a href='#'> <img style='width:70px; height:90px;' 
                                        src=".base_url('assets/images/user_default.png')." class='img-rounded'/> ".$h->nama_jabatan."<br>".$h->nama_karyawan."</a>";

        	}else if($h->foto == NULL || $h->foto == '' && $h->is_separator == 1){
        	$hasil.= "<li class='just-line'> <a href='#'> <img style='width:70px; height:90px;' 
                                        src=".base_url('assets/images/user_default.png')." class='img-rounded'/> ".$h->nama_jabatan."<br>".$h->nama_karyawan."</a>";

        	}else if($h->foto != NULL || $h->foto != '' && $h->is_separator == 0){
        	$hasil.= "<li> <a href='#'> <img style='width:70px; height:90px;' 
                                        src=".base_url('upload/').$h->foto." class='img-rounded'/> ".$h->nama_jabatan."<br>".$h->nama_karyawan."</a>";

        	}else if($h->foto != NULL || $h->foto != '' && $h->is_separator == 1){
        	$hasil.= "<li class='just-line'> <a href='#'> <img style='width:70px; height:90px;' 
                                        src=".base_url('upload/').$h->foto." class='img-rounded'/> ".$h->nama_jabatan."<br>".$h->nama_karyawan."</a>";
          
        	 
        	}
        	$hasil = $this->formasi($h->id,$hasil);
            $hasil .= "</li>";
     }
       if(($sql->num_rows())>0)
        {
            $hasil .= "</ul>";
        }
        return $hasil;

 	}
	 function getmenus($parent,$hasil){
	 	$sql = $this->db->query("select a.*,b.nama_karyawan,b.foto from m_formasi_jabatan a left join m_karyawan b on b.id = a.id_karyawan where id_parent = '".$parent."' ");
       
        if(($sql->num_rows())>0)
        {
            $hasil .= "<ul id='mainContainer' style='display:none;'>";

        }
        foreach($sql->result() as $h)
        {
        	if($h->foto == NULL || $h->foto == ''){
        		$hasil .= '<li id='.$h->id.' title="
                            <div class=\'row\'>
                                <div class=\'col-md-12\'>
                                    <div align=\'center\'>
                                        <img style=\'width:70px; height:90px;\' 
                                        src=\''.base_url('assets/images/user_default.png').'\' class=\'img-rounded\'/>
                                    </div>
                                    <div id=\'absolute_div\'>
                                 	 	<b>'.$h->nama_karyawan.' </b><br>
									    '.$h->nama_jabatan.' 
									 
									</div>
                                </div>
                                 
                                 
                            </div> 
                        ">';
        	}else{
        		$hasil .= '<li id='.$h->id.' title="
                            <div class=\'row\'>
                                <div class=\'col-md-12\'>
                                    <div align=\'center\'>
                                        <img style=\'width:70px; height:90px;\' 
                                        src=\''.base_url('upload/').$h->foto.'\' class=\'img-rounded\'/>
                                    </div>
                                     
                                 	 <div id=\'absolute_div\'>
                                 	 		<b>'.$h->nama_karyawan.' </b><br>
									    '.$h->nama_jabatan.' 
									 
									</div>
                                </div>
                                  
                        ">';
        	}
        	 
            $hasil = $this->getmenus($h->id,$hasil);
            $hasil .= "</li>";
        }
        if(($sql->num_rows())>0)
        {
            $hasil .= "</ul>";
        }
        return $hasil;

    } 
  
 
	 
}
