<?php

namespace App\Models;

use CodeIgniter\Model;

class RfidModel extends Model
{
    protected $table = 'rfid'; // Nama tabel yang digunakan oleh model

    protected $primaryKey = 'id'; // Nama primary key pada tabel

    protected $allowedFields = ['uid', 'nama', 'bagian']; // Kolom-kolom yang diizinkan untuk diisi
}
