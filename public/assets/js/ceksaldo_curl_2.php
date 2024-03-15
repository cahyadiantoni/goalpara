<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Session');
include('MyConn.php');
date_default_timezone_set('Asia/Jakarta');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//ini_set('error_reporting', 32767);



$time = date('H:i:s');
$today= date("Y:m:d");
//echo $today;
$bulan = date('m');
$tahun = date('Y');
$tahunlast=$tahun-1;
//echo json_encode($_REQUEST);
$cret='';
     
   
$kodegate=$_GET['kodegate'];
$koderf=$_GET['koderf'];
$saldopaket=0;
$idkarcis="";

        $csql3="select a.* from karcis a inner join karcis_det b on a.idkarcis=b.idkarcis where b.nobar='" . $koderf . "'";
     
        $result= mysqli_query($con,$csql3);
        $saldo=0;$idpaket=1;
     	while($rowkarcis = mysqli_fetch_object($result)){
     	    $saldo=$rowkarcis->saldo;
			$saldopaket=$rowkarcis->saldopaket;
			$idpaket=$rowkarcis->idpaket;
			$idkarcis=$rowkarcis->idkarcis;
 
     	}
     	if ($idpaket==1){
		    $csql="select * from tiket  where idgate=" . $kodegate;
			$result= mysqli_query($con,$csql);
			$harga=0;
			while($rowkarcis = mysqli_fetch_object($result)){
				$harga=$rowkarcis->harga_reg;
	 
			}     	

			if ($saldo >= $harga ){
				$cret='@*kodegate=' . $kodegate . '*saldo=' . $saldo . '*buka=1#';
			} else {
				$cret='@*kodegate=' . $kodegate . '*saldo=' . $saldo . '*buka=0#';
			}
		} else {
		  //Untuk Display
		  //ambil idgate yang sudah digunakan di karcis_trans
		  $csql = " select idgate from karcis_trans where nobar in (select nobar from karcis_det  where idkarcis ='$idkarcis')";
			$ada=0;$cst="";
			$result3= mysqli_query($con,$csql);
			while($rowtran = mysqli_fetch_object($result3)){
				$ada=1;
				$cst.= $rowtran->idgate .',';
			}	
			$cst.=" ";
	      //ambil idgate pada table paket_det
		  $csql="select a.*,b.ket_tiket from paket_det a inner join tiket b on a.idgate=b.idgate ";
		  $csql .=" where idpaket=" . $idpaket;
		  if ($ada==1){
			 $csql .=" and idgate not in ( " . $cst . ")" ;
		  }
				
			   
			$result2= mysqli_query($con,$csql);
			$ada=0;$cst="";$display="";
			$i=1;
			while($rowtran = mysqli_fetch_object($result2)){
				$cst .= $i . ". " . $rowtran->ket_tiket . " - ";
				$ada=1; $i++;
			}
			if ($ada){ $display = substr($cst,-3); } 
			
			//end untuk display
			
		    $csql="select * from paket_det  where idgate=" . $kodegate . " and idpaket=" . $idpaket;
			$result2= mysqli_query($con,$csql);
			$ada=0;$cst="";
			while($rowtran = mysqli_fetch_object($result2)){
				$ada=1;
			}
			
           if ( $kodegate==4 || $kodegate==5 || $kodegate==6 ) {
				$ada=1;
			}			
			
			if ($ada){
				
				
				
				//$scql="select * from paket where idpaket=" . $
				$csql="select * from karcis_trans  where idgate=" . $kodegate . " and nobar='" . $koderf . "'";
				$result2= mysqli_query($con,$csql);
				$ada=0;
				while($rowtran = mysqli_fetch_object($result2)){
					$ada=1;
				}     	

				if ($ada == 0 ){
					$cret='@*kodegate=' . $kodegate . '*saldo=' . $display . '*buka=1#';
				} else {
					$cret='@*kodegate=' . $kodegate . '*saldo=' . $display . '*buka=0#';
				}
			} else {
				$cret='@*kodegate=' . $kodegate . '*saldo=' . $display . '*buka=0#';
			}
		}
  
 
   // array_push( $return_arr, 1 );
    echo $cret;

?>