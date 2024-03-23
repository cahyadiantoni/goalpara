<?php

// Mendapatkan kode gate dan QR code dari parameter URL
$kodegate = $_GET['kodegate'];
$qrcode = $_GET['qrcode'];

// Lakukan validasi kode gate dan QR code di sini
// Misalnya, lakukan pengecekan di database

// Dummy data untuk simulasi pengecekan saldo
// Anda harus menggantinya dengan logika sesuai kebutuhan Anda
$dummySaldo = 1000; // Contoh: saldo sebesar 1000

// Jika saldo tersedia, buka gate dan kirim respons saldo=1
// Jika saldo tidak tersedia, jangan buka gate dan kirim respons saldo=0
if ($dummySaldo > 0) {
    $response = "@*kodegate=$kodegate*saldo=1*buka=1#";
} else {
    $response = "@*kodegate=$kodegate*saldo=0*buka=0#";
}

// Kirim respons ke gate
echo $response;

?>
