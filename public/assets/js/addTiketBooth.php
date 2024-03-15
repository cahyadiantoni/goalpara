<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With, Session');
include('MyConn.php');
date_default_timezone_set('Asia/Jakarta');



$time = date('H:i:s');
$today= date("Y:m:d");
//echo $today;
$bulan = date('m');
$tahun = date('Y');
$tahunlast=$tahun-1;
$cret='';

$users=$_GET['users'];
$rfid=trim($_GET['rfid']);
$item=$_GET['item'];
$arrItem=explode("!",$item);
$ttl=$_GET['ttl'];
$jnsbayar=$_GET['jnsbayar'];
$refno=$_GET['refno'];
		
	$csql3="select a.* from karcis a inner join karcis_det b on a.idkarcis=b.idkarcis where b.nobar='" . $rfid . "'";    
	$result= mysqli_query($con,$csql3);
	$idkarcis="";
	while($rowkarcis = mysqli_fetch_object($result)){
		$idpaket=$rowkarcis->idpaket;
		$idkarcis=$rowkarcis->idkarcis; 
	}

	if ($idkarcis != "") {         
	   for ($i=0;$i < $qtygate;$i++){
			$arrDet=explode("*",$arrItem[$i]);
			$csql3="select * from karcis_item where idkarcis==" . $idkarcis . " and idgate=" . $arrDet[0];    
			$result= mysqli_query($con,$csql3);
			$ada=0;
			while($rowkarcis = mysqli_fetch_object($result)){
				$ada=1;
			}
			if ($ada==1){
				$csql="update karcis_item set qty=qty+ " . $arrDet[1] . " where idkarcis==" . $idkarcis . " and idgate=" . $arrDet[0];    
			} else {
				$csql="insert into karcis_item (idkarcis,idgate,qty,harga) values ('" . $idkarcis . "','" . $arrDet[0] . "','" . $arrDet[1] . "','"  . $arrDet[2] . "') ";  
			}			  
			mysqli_query($con,$csql);
	  }
	   
	   $csql2="insert into karcis_pay (idkarcis,tglpay,jampay,kdpay,jumlah,refno,kduser) values ('$idkarcis','$today','$time','$jnsbayar','$ttl','$refno','$users') ";
	   mysqli_query($con,$csql2);
	   
	   $cret="Berhasil direkam!";

	} else {
	  $cret= "Error: No.QRcode Belum didaftarkan<br>" . $con->error;
	}  

    echo $cret;

?>