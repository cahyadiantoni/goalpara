<?php

namespace App\Models;

use CodeIgniter\Model;

class WahanaModel extends Model
{
    protected $table = 'wahana'; // Nama tabel yang digunakan oleh model

    protected $primaryKey = 'id'; // Nama primary key pada tabel

    protected $allowedFields = ['name', 'code', 'kategori', 'kapasitas', 'harga', 'status']; // Kolom-kolom yang diizinkan untuk diisi
}
