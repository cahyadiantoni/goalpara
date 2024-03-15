<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tikets'; // Nama tabel yang digunakan oleh model

    protected $primaryKey = 'id'; // Nama primary key pada tabel

    protected $allowedFields = ['name', 'code', 'harga_reg']; // Kolom-kolom yang diizinkan untuk diisi
}
