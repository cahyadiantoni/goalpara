<?php

namespace App\Models;

use CodeIgniter\Model;

class SelectedTransactionModel extends Model
{
    protected $table = 'selected_transaction'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['transaction_id', 'tiket', 'wahana_id', 'amount']; // Kolom yang diizinkan untuk disimpan

    // Metode atau fungsi lainnya sesuai kebutuhan aplikasi Anda
}

