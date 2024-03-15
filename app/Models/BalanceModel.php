<?php

namespace App\Models;

use CodeIgniter\Model;

class BalanceModel extends Model
{
    protected $table = 'balance'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['tiket', 'wahana_id', 'amount']; // Kolom yang diizinkan untuk disimpan

    // Metode atau fungsi lainnya sesuai kebutuhan aplikasi Anda
}

