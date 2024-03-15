
// Wait for the deviceready event before using any of Cordova's device APIs.
// See https://cordova.apache.org/docs/en/latest/cordova/events/events.html#deviceready
//document.addEventListener('deviceready', onDeviceReady, false);
//var ptAddr='60:6E:41:43:5F:B4'; //Printer Besar
var ptAddr='66:22:82:72:4F:E0';  //Printer Kecil
var gHarga=0;arrGate = [];ghargaMasuk=0;gJual=1;
var deviceid;
var currentQR = '';

var app = {
    // Application Constructor
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },
    onDeviceReady: function() {
        this.receivedEvent('deviceready');
		deviceid=device.uuid;
		//deviceid='1234';
		console.log(deviceid);
			 StatusBar.overlaysWebView(true);

			getDateTimeDisp();
			getHarga(1);
			getPrinter();
			},

    // Update DOM on a Received Event
    receivedEvent: function(id) {
    }
};
app.initialize();

let datanbr = [0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];


 
//printing default value of data that is 0 in h2 tag
//document.getElementById("counting").innerText = datanbr;
 
//creation of increment function
function increment(idg) {
	datanbr[idg] = datanbr[idg] + 1;
	//console.log(datanbr[idg]);
	document.getElementById("counting_"+idg).innerText = datanbr[idg];
	hrg=$('#aharga_'+idg).text();
	aHrg=hrg.split("#");
	console.log('aHrg : '+aHrg[0]);
	n=datanbr[idg]-1;
	console.log('jumlah = '+datanbr[idg]);
	let hrgsatuan = aHrg[0];
	let totharga = datanbr[idg]*hrgsatuan;
	console.log(totharga);
	//$('#harga_'+idg).text(nbrFrmt(aHrg[n]));
	$('#harga_'+idg).text(nbrFrmt(totharga));
	
	if (gJual==1){
		rfsTotal();
	} else {
		rfsBoothTotal();
	}
}
//creation of decrement function
function decrement(idg) {
	if (datanbr[idg]>1){
		datanbr[idg] = datanbr[idg] - 1;
		console.log(datanbr[idg]);
		document.getElementById("counting_"+idg).innerText = datanbr[idg];
		hrg=$('#aharga_'+idg).text();
		aHrg=hrg.split("#");
		n=datanbr[idg]-1;
		$('#harga_'+idg).text(nbrFrmt(aHrg[n]));
		if (gJual==1){
			rfsTotal();
		} else {
			rfsBoothTotal();
		}
	}
}

function cekLogin(){
	//StatusBar.styleDefault();
	document.getElementById('login').style.display = "none";
	document.getElementById('main').style.display = "block";
	
		
}
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
function getDateTime(){
var currentdate = new Date();
var datetime = currentdate.getDate()  + "/"   
+ (currentdate.getMonth() + 1) 
+ "/" + currentdate.getFullYear() + " @ " 
+ currentdate.getHours() + ":" 
+ currentdate.getMinutes() + ":" + currentdate.getSeconds();
return datetime	
}

function getDateTimeDisp(){
var currentdate = new Date();
var datetime = currentdate.getDate()  + " "   
+ bulan((currentdate.getMonth())).substring(0,3) 
+ " " + currentdate.getFullYear() 
cdsp="<span style='color:#f8cb5d;font-size:20px;font-weight:bold;'>" + datetime + "</span>";
$('#dsptgl').html(cdsp);
//return cdsp	
}

function cetakRefund(jmlref){
	//jmlref=unFrmt(jmlref);
   //alert(jmlref);	
	tgl=getDateTime();

	//qty=$('#counting').val();
	//depo=unFrmt( $('#depo').val());
	ttl=unFrmt( $('#ttl').text());
	jnsbayar=$('#jnsbayar').val();
	//jnspaket=$('#jnspaket').val();
	refno=$('#refno').val();	
	
ThermalPrinter.printFormattedText({
    type: 'bluetooth',
	id: ptAddr,
    text: "[L]\n" +
	 
        "[C]<u><font size='big'>Slip Refund</font></u>\n" +
        "[L]\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]<b>Refund</b>[R]" + nbrFrmt(jmlref) + "\n" +
        "[L]\n" +
        "[C]--------------------------------\n" +
        "[R]TOTAL CASH :[R]" + nbrFrmt(jmlref) + "\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]Kasir : (" + gnokav + ") " + gNama + "\n" +
		"[L]Date  : " + tgl  + "\n" +
        "[L]\n" +
		"[L]\n" 
      
	  }, function() {
		 // cetakQr();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}

function cetakTopup(){
	qrnum=$('#rfid').text();
	depo=$('#depotopup').val();
	depo=unFrmt(depo);
	ttl=depo;
	tgl=getDateTime();
ThermalPrinter.printFormattedText({
    type: 'bluetooth',
	id: ptAddr,
   text: "[L]\n" +
	 
        "[C]<u><font size='big'>Slip Topup</font></u>\n" +
        "[L]\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]<b>Depossit</b>[R]" + nbrFrmt(depo) + "\n" +
        "[L]\n" +
        "[C]--------------------------------\n" +
        "[R]TOTAL CASH :[R]" + nbrFrmt(ttl) + "\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]Kasir : (" + gnokav + ") " + gNama + "\n" +
		"[L]Date  : " + tgl  + "\n" +
        "[L]\n" +
		"[L]\n" 
      
	  }, function() {
		 // cetakQr();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}
function clearBooth(){
	
	
$('#rfidbooth').val('');
$('#ttlbooth').text('');
$('#refno').val('');
for (i=7;i<50;i++){
   citem=document.getElementById('item_'+i);
  if (citem != null ){
   citem.remove();
  }
}

}

function clearLoket(){
	
	
$('#rfidtiket').val('');
$('#rfQty').text('');
//$('#qty').val('');
$('#phone').val('');
//$('#depo').val('');
$('#ttl').text('');
$('#refno').val('');
for (i=7;i<50;i++){
   citem=document.getElementById('item_'+i);
  if (citem != null ){
   citem.remove();
  }
}

}
function cetakBooth(){
	qrnum=$('#rfidbooth').val();
	ttl=$('#ttlbooth').text();
	ttl=unFrmt(ttl);
	tgl=getDateTime();

	cst="";
	for (i=0;i<arrGate.length;i++){
		gt=arrGate[i];		
		qty=unFrmt( $('#counting_'+gt).text());
		ket=$('#ket_'+gt).text();
		hrg=unFrmt( $('#harga_'+gt).text());
		//cst += gt+ "*"+qty+"*"+hrg+"!";
		cst += "[L]<b>" + ket + "</b>(" + qty + ")[R]" + nbrFrmt(hrg) + "\n" ;
	}
	
ThermalPrinter.printFormattedText({
    type: 'bluetooth',
	id: ptAddr,  // You can also use the identifier directly i. e. 00:11:22:33:44:55 (address) or name
    text: "[L]\n" +
	 
        "[C]<u><font size='big'>Goalpara</font><font size='tall'>Teapark</font></u>\n" +
         "[C]================================\n" +
        "[L]\n" +
		cst +
        "[L]\n" +
        "[C]--------------------------------\n" +
        "[R]TOTAL CASH :[R]" + nbrFrmt(ttl) + "\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]Kasir : (" + gnokav + ") " + gNama + "\n" +
		"[L]Date  : " + tgl  + "\n" +
        "[L]\n" +
		"[C]=====IG : @goalparateapark=====\n" +
		"[L]\n" 
      
	  }, function() {
		  cetakQrBooth(qrnum);
		 clearBooth();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}

function cetak(){
	qrnum=$('#rfidtiket').val();
	ttl=$('#ttl').text();
	ttl=unFrmt(ttl);
	tgl=getDateTime();
	qtyd=$('#counting').text();
	hrgt=$('#hrgtiket').text();
	//cst="4*"+qty+"*"+unFrmt(hrgt)+"!";
	cst="";
	for (i=0;i<arrGate.length;i++){
		gt=arrGate[i];		
		qty=unFrmt( $('#counting_'+gt).text());
		ket=$('#ket_'+gt).text();
		hrg=unFrmt( $('#harga_'+gt).text());
		//cst += gt+ "*"+qty+"*"+hrg+"!";
		cst += "[L]<b>" + ket + "</b>(" + qty + ")[R]" + nbrFrmt(hrg) + "\n" ;
	}
	
ThermalPrinter.printFormattedText({
    type: 'bluetooth',
	id: ptAddr,  // You can also use the identifier directly i. e. 00:11:22:33:44:55 (address) or name
    text: "[L]\n" +
	 
        "[C]<u><font size='big'>Goalpara</font><font size='tall'>Teapark</font></u>\n" +
         "[C]================================\n" +
        "[L]\n" +
        "[L]<b>Ticket Masuk </b>(" + qtyd + ")[R]" + nbrFrmt(hrgt)+ "\n" +
		cst +
        "[L]\n" +
        "[C]--------------------------------\n" +
        "[R]TOTAL CASH :[R]" + nbrFrmt(ttl) + "\n" +
        "[C]================================\n" +
        "[L]\n" +
        "[L]Kasir : (" + gnokav + ") " + gNama + "\n" +
		"[L]Date  : " + tgl  + "\n" +
        "[L]\n" +
		"[C]=====IG : @goalparateapark=====\n" +
		"[L]\n" 
      
	  }, function() {
		  cetakQr(qrnum);
		 clearLoket();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}
function cetakQrBooth(n){
	qrnum=$('#rfidbooth').val();
	//myArray = qrnum.split(" ");
	//qrnum=myArray[0];
	qrnum=qrnum.replace(/[^a-zA-Z0-9 ]/g, '');
	//alert(qrnum);
	

ThermalPrinter.printFormattedText({
    type: 'bluetooth',
    id: ptAddr, // You can also use the identifier directly i. e. 00:11:22:33:44:55 (address) or name
    text: "[L]\n" +
        "[C]<qrcode size='16'>" + qrnum +"</qrcode>\n" +
		"[L]\n" +
		"[L]\n" +
		"[L]\n" 
      
	  }, function() {
		  clearBooth();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}

function cetakQr(n){
	qrnum=$('#rfidtiket').val();
	myArray = qrnum.split(" ");
	qrnum=myArray[0];
	qrnum=qrnum.replace(/[^a-zA-Z0-9 ]/g, '');
	//alert(qrnum);
	

ThermalPrinter.printFormattedText({
    type: 'bluetooth',
    id: ptAddr, // You can also use the identifier directly i. e. 00:11:22:33:44:55 (address) or name
    text: "[L]\n" +
        "[C]<qrcode size='16'>" + qrnum +"</qrcode>\n" +
		"[L]\n" +
		"[L]\n" +
		"[L]\n" 
      
	  }, function() {
		  clearKarcis();
    console.log('Successfully printed!');
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
});
	
}
//Booth
function ScanQrBooth(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result2) {
	crf=$('#rfidbooth').val();
	crf=crf.toString();
    $('#rfidbooth').val(result2);
	rfsBoothTotal();
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}

function rfsBoothTotal(){
	//hrgtiket=parseInt(unFrmt( $('#hrgtiket').text()));
	hrg=0;nlen=arrGate.length;
	for (i=0;i<nlen;i++){
		gt=arrGate[i];
		hrg += parseInt(unFrmt( $('#harga_'+gt).text()));
	}	
	$('#ttlbooth').text(nbrFrmt(hrg));
}
function openWahana(npage){
	gJual=npage;
	openPage('daftarwahana');
}
//End Booth

function cekNilaiQR() {
  setTimeout(function() {
    if (currentQR=='') {
      cekNilaiQR();
    }else{
		$('#preview0').hide();
		//alert(result);
		crf=$('#rfidtiket').val();
		qty=$('#rfQty').text();
		if (qty=='') { qty=0 } else { qty=parseInt(qty);}
		qty=qty+1;
		$('#rfQty').text(qty);
		$('#counting').text(qty);
		$('#hrgtiket').text(nbrFrmt(ghargaMasuk*qty));
		//RefreshHarga();
		crf=crf.toString();
		$('#rfidtiket').val(crf+currentQR+' ');
		rfsTotal();
	}
  },3000)
}

function ScanQrTiket(){
	$('#preview0').show();
	currentQR = '';
	cekNilaiQR();
	/*  
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result2) {
	//alert(result);
	crf=$('#rfidtiket').val();
	qty=$('#rfQty').text();
	if (qty=='') { qty=0 } else { qty=parseInt(qty);}
	qty=qty+1;
	$('#rfQty').text(qty);
	$('#counting').text(qty);
	$('#hrgtiket').text(nbrFrmt(ghargaMasuk*qty));
	//RefreshHarga();
	crf=crf.toString();
    $('#rfidtiket').val(crf+result2+' ');
	rfsTotal();
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
*/
}
function lostFocus(){
	//alert(result);
	crf=$('#rfidtiket').val()+" ";
	arrCrf=crf.split(" ");
	cqty=arrCrf.length-1;
	console.log(cqty);
	$('#rfQty').text(cqty);
	$('#counting').text(cqty);
	$('#hrgtiket').text(nbrFrmt(ghargaMasuk*cqty));
	rfsTotal();	
}

function ScanQr(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result) {
	//alert(result);
    $('#rfidtopup').html(result);
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}
function ScanQrCekGate(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result) {
	//alert(result);
    $('#rfidcek').html(result);
	getSaldoGate(result);
	
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}


function ScanQrCek(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result) {
	//alert(result);
    $('#rfidcek').html(result);
	getSaldo(result);
	
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}

function ScanQrCekout(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result) {
	//alert(result);
    $('#rfidcekout').html(result);
	getSaldoCo(result);
	
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}
function ScanQrRefund(){
 window.plugins.zxingPlugin.scan(
 {
    'prompt_message':'Scan a barcode', // Change the info message. A blank message ('') will show a default message
    'orientation_locked':true, // Lock the orientation screen
    'camera_id':0, // Choose the camera source
    'beep_enabled':true, // Enables a beep after the scan
    'scan_type':'normal', // Types of scan mode: normal = default black with white background / inverted = white bars on dark background / mixed = normal and inverted modes
    'barcode_formats':[
        'QR_CODE'], // Put a list of formats that the scanner will find. A blank list ([]) will enable scan of all barcode types
    'extras':{} // Additional extra parameters. See [ZXing Journey Apps][1] IntentIntegrator and Intents for more details
},function(result) {
	//alert(result);
    $('#rfidrefund').html(result);
	getSaldoRefund(result);
	
}, function(error) {
	salah=JSON.stringify(error);
    alert(salah);
})
}

function cekLocal(){

 $.ajax({
        url: "/goalpara/ceksaldo_test.php?kodegate=1&koderf=1000000020",
        type: "GET",
        dataType: "json",
        contentType: 'application/json',
        success: function() {
             alert(data[0].data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + jqXHR.responseText);
        }
    });
}

function getSaldoRefund(rfidcek){
	
   curl= "/goalpara/cektransaksi.php?rfid="+rfidcek;
	//alert(curl);
	$.ajax({
    url: "/goalpara/cektransaksi.php?refund&rfid="+rfidcek,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		$('#refund').html(jsondata);
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function getPrinter(){
	$.ajax({
    url: "/goalpara/getPrinter.php?deviceid="+deviceid,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		
		ptAddr=jsondata.replace(/(\r\n|\n|\r)/gm, "");
		//alert(ptAddr);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function getHarga(hrgId){
	
   //curl= "/goalpara/cekharga.php?rfid="+rfidcek;
	//alert(curl);
	$.ajax({
    url: "/goalpara/cekharga.php?hrgId="+hrgId,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		gHarga=parseInt(jsondata);
		//alert(gHarga);
		//$('#cekout').html(jsondata);
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}


function getWahana(){
	
	clen = arrGate.length;
	cst=""; ada=0;
	for (i=0;i<clen;i++){
		cst +=arrGate[i] + ",";
	}
	//cst="100)";
	nLen=cst.length-1;
	if(ada==0){ cst=""; } else {cst=cst.substring(0,nlen); } 
	
   curl= "/goalpara/getWahana.php?ada="+cst;
	//alert(curl);
	$.ajax({
    url: curl,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		$('#listform').html(jsondata);
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}


function getSaldoCo(rfidcek){
	
   curl= "/goalpara/cektransaksi.php?rfid="+rfidcek;
	//alert(curl);
	$.ajax({
    url: "/goalpara/cektransaksi.php?co&rfid="+rfidcek,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		$('#cekout').html(jsondata);
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function checkOut(rfidcek){
	$.ajax({
    url: "/goalpara/checkout.php?rfid="+rfidcek,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
        alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
	});	  		  	
}

function kasirTab(){
	openTab('keuangankasir');
	resumekasir();
}

function cetakResume(){
	$.ajax({
    url: "/goalpara/kasir_resume.php?kduser=" + gnokav ,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		var arrKasir = jQuery.parseJSON(jsondata);
	  cst="";
		for (i=0;i<arrKasir.length;i++){
			no=i+1;
			cst += "[L]" +  no + "  " + arrKasir[i].payname + "[R]" + nbrFrmt(arrKasir[i].ttl)+ "\n" ;
		}
	
	tgl=getDateTime();
			ThermalPrinter.printFormattedText({
			type: 'bluetooth',
			id: ptAddr, // You can also use the identifier directly i. e. 00:11:22:33:44:55 (address) or name
			text: "[L]\n" +
			 
				"[C]<u><font size='big'>Slip Kasir</font></u>\n" +
				 "[C]================================\n" +
				"[L]\n" + cst +
				"[L]\n" +
				"[C]================================\n" +
				"[L]\n" +
				"[L]Kasir : (" + gnokav + ") " + gNama + "\n" +
				"[L]Date  : " + tgl  + "\n" +
				"[L]\n" +
				"[C]========Goalpara Teapark========\n" +
				"[L]\n" 
			  
			  }, function() {
				 // cetakQr();
				 //clearLoket();
			console.log('Successfully printed!');
			}, function(error) {
				salah=JSON.stringify(error);
				alert(salah);
			});		
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
	
}

function getTiketMasuk(){
refno='';
	$.ajax({
    url: "/goalpara/daftarWahana.php?checkin",
    method : "GET",
    success: function(jsondata) {
		//console.log(jsondata);
		var data = jQuery.parseJSON(jsondata);
		
        cst="";
		for (i=0;i<data.length;i++){
			no=i+1;
			    ngt=data[i].idgate;
				if (ngt==4){
			    ghargaMasuk=data[i].harga_reg;
				}
	
			
			
		}
		$('#hrgtiket').text(nbrFrmt(ghargaMasuk));
		$('#ttl').text(nbrFrmt(ghargaMasuk));

   },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function daftarWahana(){
refno='';
	clen = arrGate.length;
	cst=""; nada=0;
	for (i=0;i<clen;i++){
		 nada=1;
		cst +=arrGate[i] + ",";
	}
	//cst="100)";
	nlen=cst.length-1;
	if(nada==0){ cst=""; } else {cst=cst.substring(0,nlen); } 
	
	$.ajax({
    url: "/goalpara/daftarWahana.php?ada="+cst,
    method : "GET",
    success: function(jsondata) {
		//console.log(jsondata);
		var data = jQuery.parseJSON(jsondata);
		
        cst="";
		for (i=0;i<data.length;i++){
			no=i+1;
			    charga=data[i].harga_reg +'#' + data[i].harga_reg2+'#'+data[i].harga_reg3;
				/*
				charga = '';
				for(x=1;x<=100;x++) {
					let xxhrga = x+data[i].harga_reg;
					charga += xxhrga+'#';
				}
				*/
				cst +='<div class="item" style="padding:5px 15px;" onclick="addWahana(' + "'" + data[i].idgate + "','" + data[i].ket_tiket + "','" + charga + "'" + ')">';
				cst +='<div class="left">';
				cst +='<i class="material-icons" style="font-size:20px;">account_balance</i>';
				cst +='</div>';
				cst +='<div style="border-bottom:0px #ccc solid;font-size:14px;color:#000;padding-bottom:15px;width:100%;">' + data[i].ket_tiket + '</div>';
				cst +='<div class="right" style="padding-bottom:15px;">';
				cst += nbrFrmt(data[i].harga_reg);
				cst +='</div>';
				cst +='</div>';
			
			
		}
		//cst +="</div>";
		//$('#daftarwahana').html();
		$(cst).appendTo('#daftarwahana');
   },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}
function removeWahana(iditem,idgate){
	document.getElementById(iditem).remove();	
	for (let i = 0; i < arrGate.length; i++) { 
        if (arrGate[i] === idgate) { 
            let spliced = arrGate.splice(i, 1);          
        } 
    }
		if (gJual==1){
			rfsTotal();
		} else {
			rfsBoothTotal();
		}
		//console.log(arrGate);
}

function addWahana(kodegate,ket,hrg){
	backPage();
	aHrg=hrg.split("#");
	cst='<div class="item" id="item_'+ kodegate + '">';
	
	cst +='<div id="aharga_'+ kodegate + '" style="display:none;">' + hrg  + '</div>';

	cst +='';
	cst +='<h2 style="font-size:14px;"><i onclick="removeWahana(' + "'" + 'item_'+ kodegate +  "','" + kodegate +  "'" +');" class="material-icons" style="font-size:28px;margin-right:10px;color:red;">disabled_by_default</i><span id="ket_'+ kodegate + '" style="vertical-align: top;heigh:20px;padding-top:5px;font-size:12px;">' + ket + '</span> - ';
	cst +='<span style="vertical-align: top;padding-top:5px;heigh:20px;" id="harga_'+ kodegate + '" >' + nbrFrmt(aHrg[0]) + '</span></h2>';
	cst +='<div class="right" style="width:80px;">';
	   
		 cst +='<button onclick="decrement(' + "'" + kodegate + "'" + ')" class="buttonNbr" style="text-align:center;"><i class="material-icons" style="font-size:20px;margin-left:-10px;">arrow_left</i></button>';
		cst +='<h2 id="counting_' + kodegate + '" style="min-height:20px;font-size:14px;min-width:25px;text-align:center;">1</h2>';
		cst +='<button onclick="increment(' + "'" + kodegate + "'" + ')" class="buttonNbr" style="text-align:center;"><i class="material-icons" style="font-size:20px;margin-left:-10px;">arrow_right</i></button> ';       
	cst +='</div>';
	cst +='</div>';
	$(cst).appendTo('#keranjang');
	arrGate.push(kodegate);
	//console.log(arrGate);
	if (gJual==1){
		rfsTotal();
	} else {
		rfsBoothTotal();
	}

	
}


function resumekasir(){
refno='';
	$.ajax({
    url: "/goalpara/kasir_resume.php?kduser=" + gnokav ,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		var data = jQuery.parseJSON(jsondata);
		cst="<table style='width:100%;'><tr><td>NO</td><td>PAY METHOD</td><td style='text-align:right;'>AMOUNT</td></tr>";
		for (i=0;i<data.length;i++){
			no=i+1;
			cst +="<tr>";
			cst +="<td style='width:10%;'>" + no + "</td><td style='width:60%;'>" + data[i].payname + "</td><td style='width:30%;text-align:right;'>" + nbrFrmt(data[i].ttl) + "</td>";
			
			cst +="</tr>";
			
		}
		cst +="<table>";
		cst +="<br>";
		cst +="<div style='margin:10px auto;width:120px;height:30px;padding:5px;border-radius:20px;background-color:#259e73;color:#fff;text-align:center;' onclick='cetakResume()'>Cetak</div>";
		$('#resume').html(cst);
		
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}


function refund(rfidcek){
jmlref=$('#saldobal').html();
jmlref=unFrmt(jmlref);
refno='';
	$.ajax({
    url: "/goalpara/refund.php?rfid="+rfidcek +'&users=' + gnokav + '&jmlref='+jmlref ,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
        alert(jsondata);
		cetakRefund(jmlref);
		$('#rfidrefund').html('');
		$('#refund').html('');
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function konfirSaldo(){
	rfidcek=$('#rfidcek').text();
	curl= "/goalpara/konfir_saldo_curl_2.php?kodegate="+ vargt + "&koderf="+rfidcek;
	//alert(curl);
	$.ajax({
    url: curl,
    method : "GET",
	// dataType : "html",
   // contentType: "application/json; charset=utf-8",
    success: function(jsondata) {
		console.log(jsondata);
		cret=jsondata.split('*');
		buka="";
		if(cret.length>2){
			buka=cret[3];
			cket=cret[2];
			cket=cket.replace("-", "</br>");
			cket=cket.replace("saldo=", "");
			cket=cket+"<br><br>Data Berhasil CheckIn";
		   $('#transaldo').html(cket);
		}
		
		$("#btnCheck").attr("style", "display:none");
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
	
}
function getSaldoGate(rfidcek){
	
	//rfidcek=$('#rfidcek').text();
   curl= "/goalpara/ceksaldo_curl_2.php?kodegate="+ vargt + "&koderf="+rfidcek;
	//alert(curl);
	$.ajax({
    url: curl,
    method : "GET",
	 dataType : "html",
    contentType: "application/json; charset=utf-8",
    success: function(jsondata) {
		console.log(jsondata);
		cret=jsondata.split('*');
		buka="";
		if(cret.length>2){
			buka=cret[3];
			cket=cret[2];
			cket=cket.replace("-", "</br>");
			cket=cket.replace("saldo=", "");
		   $('#transaldo').html(cket);
		}
		//alert(buka);
		pos=buka.indexOf("1");
		if (pos > 0){
			$("#btnCheck").attr("style", "display:block");
		} else {
			$("#btnCheck").attr("style", "display:none");
		}
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function getSaldo(rfidcek){
	
	//rfidcek=$('#rfidcek').text();
   curl= "/goalpara/cektransaksi.php?rfid="+rfidcek;
	//alert(curl);
	$.ajax({
    url: "/goalpara/cektransaksi.php?rfid="+rfidcek,
    method : "GET",
	 dataType : "html",
    contentType: "application/json; charset=utf-8",
    success: function(jsondata) {
		console.log(jsondata);
		$('#trans').html(jsondata);
      // alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function clearKarcis(){
	//window.location.reload(true);
	
	$('#jnsbayar').val(1);
	$("#ketbayar").html('Tunai');
	$('#rfidtiket').val('');
	$('#phone').val('');
	$('#qty').val('');
	$('#counting').text('');
	$('#refno').val('');
	$('#ttl').text('');
	$('#hrgtiket').text(nbrFrmt(ghargaMasuk));
	arrGate=[];
}

function saveTopup(){
	
	rfidopup=$('#rfidtopup').text();
	depo=unFrmt( $('#depotopup').val());
	jnsbayar=$('#jnsbayar').val();
	refno=$('#refnotopup').val();
   curl= "/goalpara/saveTopup.php?rfid="+rfidopup+"&depo="+depo+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav,
	
	$.ajax({
    url: "/goalpara/saveTopup.php?rfid="+rfidopup+"&depo="+depo+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		cetakTopup();
       alert(jsondata);
	   

    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function rfsTotal(){
	hrgtiket=parseInt(unFrmt( $('#hrgtiket').text()));
	hrg=0;nlen=arrGate.length;
	for (i=0;i<nlen;i++){
		gt=arrGate[i];
		hrg += parseInt(unFrmt( $('#harga_'+gt).text()));
	}	
	$('#ttl').text(nbrFrmt(hrgtiket+hrg));
}

function saveData(){	
	rfid=$('#rfidtiket').val();
	phone=$('#phone').val();
	qty=$('#counting').text();
	hrgt=$('#hrgtiket').text();
	cst="4*"+qty+"*"+unFrmt(hrgt)+"!";
	for (i=0;i<arrGate.length;i++){
		gt=arrGate[i];
		qty=unFrmt( $('#counting_'+gt).text());
		hrg=unFrmt( $('#harga_'+gt).text());
		cst += gt+ "*"+qty+"*"+hrg+"!";
	}
	//qty=$('#counting').val();
	//depo=unFrmt( $('#depo').val());
	ttl=unFrmt( $('#ttl').text());
	jnsbayar=$('#jnsbayar').val();
	//jnspaket=$('#jnspaket').val();
	refno=$('#refno').val();
	//console.log("/goalpara/addTiket3.php?rfid="+rfid+"&phone="+phone+"&item="+cst+"&ttl="+ttl+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav);
	$.ajax({
    url: "/goalpara/addTiket3.php?rfid="+rfid+"&phone="+phone+"&qty="+qty+"&item="+cst+"&ttl="+ttl+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		hideLoader();
       alert("Data telah direkam!");
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}
function saveDataBooth(){	
	rfid=$('#rfidbooth').val();
	//alert(rfid);
	phone=$('#phone').val();
	//qty=$('#counting').text();
	//hrgt=$('#hrgtiket').text();
	cst="";
	for (i=0;i<arrGate.length;i++){
		gt=arrGate[i];
		qty=unFrmt( $('#counting_'+gt).text());
		hrg=unFrmt( $('#harga_'+gt).text());
		cst += gt+ "*"+qty+"*"+hrg+"!";
	}
	//qty=$('#counting').val();
	//depo=unFrmt( $('#depo').val());
	ttl=unFrmt( $('#ttlbooth').text());
	jnsbayar=$('#jnsbayar').val();
	//jnspaket=$('#jnspaket').val();
	refno=$('#refno').val();
	//console.log("/goalpara/addTiketBooth.php?rfid="+rfid+"&item="+cst+"&ttl="+ttl+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav);
	$.ajax({
    url: "/goalpara/addTiketBooth.php?rfid="+rfid+"&item="+cst+"&ttl="+ttl+"&refno="+refno+"&jnsbayar="+jnsbayar+"&users="+gnokav,
    method : "GET",
    success: function(jsondata) {
		//console.log(jsondata);
		hideLoader();
       alert(jsondata);
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
});	  
		  	
}

function logProses(){
	agt=$('#username').val();
	passwd=$('#passwd').val();
	$.ajax({
		url: "/goalpara/ceklogin2.php?userid="+agt+"&password=" + passwd,		
		method : "GET",
		dataType: "json",
		contentType: 'application/json',
		success: function(jsondata) {
			data=jsondata;
			console.log(data);
			if (data.length!=0){
				gNama=data[0].nama;
				gnokav=data[0].kode;
				
				$('#gnama').html(gNama);
			    $('#gkav').html(gnokav);
					
			
				  $('#login').css("display", "none");
					$('#main').css("display", "block");
					$('#menubar').css("display", "block");			  
					//$('#namakar').text(gNama);
					//$('#singkatan').text(an1);
					bln=getBulan();
					//$('#calbulan').text(bln);
					//initKalender();
					  var dt = new Date();
					  today=dt.getDate();
					  bl=dt.getMonth()+1;
					  tahun=dt.getFullYear();

			} else {
				 $('#info').text('Id atau Password salah!');
			}
			
		},
		error: function(jqXHR, textStatus, errorThrown) {
			
			alert("msg: "+errorThrown+" , status: "+jqXHR.status);
			//alert(textStatus + jqXHR.responseText);
		}
	});	  
}
function getDaysInMonth(year, month) {
  return new Date(year, month, 0).getDate();
}

function getBulan(){
	var dt = new Date();
  newdate = bulan(dt.getMonth()) + ' ' +  dt.getFullYear();
 //  + "/" +  "/" + dt.getDate();	
	return newdate;
}


function bulan(bl){
	switch (bl) {
  case 0:
    bl = "Januari";
    break;
  case 1:
    bl = "Februari";
    break;
  case 2:
    bl = "Maret";
    break;
  case 3:
    bl = "April";
    break;
  case 4:
    bl = "Mei";
    break;
  case 5:
    bl = "Juni";
    break;
  case 6:
    bl = "Juli";
    break;
  case 7:
    bl = "Agustus";
    break;
  case 8:
    bl = "September";
    break;
  case 9:
    bl = "Oktober";
    break;
  case 10:
    bl = "November";
    break;
  case 11:
    bl = "Desember";
    break;
}
return bl;
}


function hari(hr){
switch (hr) {
  case 0:
    day = "M";
    break;
  case 1:
    day = "S";
    break;
  case 2:
     day = "S";
    break;
  case 3:
    day = "R";
    break;
  case 4:
    day = "K";
    break;
  case 5:
    day = "J";
    break;
  case 6:
    day = "S";
}
return day;
}


document.addEventListener('openPage', function(e){
	//console.log(e.detail.page); 
	cpage=e.detail.page;
	if (cpage=='tiket.html'){
		gJual=1;
		getTiketMasuk();
		arrGate=[];
		//n=no_agt;
		//qrnumber=Math.floor(10000000000 + Math.random() * 90000000000); //Math.floor(Math.random() * 1000000000);
		//qrnumber=qrnumber.toString();
		//$('#rfidtiket').html('');
	}
	if (cpage=='printer.html'){

		$('#ptrAddr').val(ptAddr);
	}
	if (cpage=='booth.html'){
		//getTiketMasuk();
		gJual=2;
		arrGate=[];
		//n=no_agt;
		//qrnumber=Math.floor(10000000000 + Math.random() * 90000000000); //Math.floor(Math.random() * 1000000000);
		//qrnumber=qrnumber.toString();
		//$('#rfidtiket').html('');
	}

   if (cpage=='daftarwahana.html'){	
		daftarWahana();
	}
	
    if (cpage=='listwahana.html'){	
		getWahana();
	}
	if (cpage=='wahana.html'){	
		$("#ketwahana").html(varketgt);
		$("#jnswahana").val(vargt);
	}
})
var varketg=""; var vargt="";
function pilihopsiwahana(gt,ketgt){
	//backPage();
	varketgt=ketgt;
	vargt=gt;
	openPage('wahana');
    //alert(ketgt);

	
	
}


function pilihopsipaket(jns){
	backPage();
	if (jns==1) { 
		cket="Reguler"; 
	} else if (jns==2) { 
		cket="SPR-1";	
		$("#ttl").html(nbrFrmt(350000));
	} else if (jns==3) { 
	   cket="SPR-2";
	   $("#ttl").html(nbrFrmt(420000));
	}
	$("#ketpaket").html(cket);
	$("#jnspaket").val(jns);
	
	
}


function pilihopsibayar(jns){
	backPage();
	if (jns==1) { 
		cket="Tunai"; 
	} else if (jns==2) { 
		cket="Kartu Debit";		
	} else if (jns==3) { 
	   cket="QRIS";
	} else if (jns==4) { 
	   cket="Kartu Kerdit";
	}
	$("#ketbayar").html(cket);
	$("#jnsbayar").val(jns);
	
	
}
function RefreshHarga(){
	depo=$('#depo').val();
	if (depo==""){
		depo=0;
	} else {
	   depo=parseInt(depo);
	}
	
	karcis=parseInt($('#qty').val())*gHarga;
	$("#ttl").html(nbrFrmt(karcis+depo));
}
function nbrFrmt(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function unFrmt(x) {
	return parseInt(x.replace(/,/g, ''));
}

function RekamPrinter(){
	mac=$('#ptrAddr').val();
	if (mac==""){
		alert('MacAddr harus diisi!');
	} else {
		//showLoader();
	$.ajax({
    url: "/goalpara/rekamPrinter.php?mac="+mac+"&deviceid="+deviceid,
    method : "GET",
    success: function(jsondata) {
		console.log(jsondata);
		
       alert("Data telah direkam!");
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus + jqXHR.responseText);
		alert(textStatus + jqXHR.responseText);
    }
	});

	}
}
function rekamData(){
	qr=$('#rfidtiket').val();
	if (qr==""){
		alert('Nomor QR harus diisi!');
	} else {
		showLoader();
		saveData();
		//connectPrinter();
		cetak();
		//disconnectPrinter();
	}
}

function rekamDataBooth(){
	qr=$('#rfidbooth').val();
	if (qr==""){
		alert('Nomor QR harus diisi!');
	} else {
	showLoader();
	saveDataBooth();
	//connectPrinter();
	cetakBooth();
	}
	//disconnectPrinter();
}
function showLoader(){
$('#loader').css('display','block');
}
function hideLoader(){
$('#loader').css('display','none');
}
