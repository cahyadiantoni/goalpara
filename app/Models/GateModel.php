<?php

namespace App\Models;

use CodeIgniter\Model;

class GateModel extends Model
{
    protected $table = 'gate'; // Nama tabel yang digunakan oleh model

    protected $primaryKey = 'id'; // Nama primary key pada tabel

    protected $allowedFields = ['name', 'code', 'status']; // Kolom-kolom yang diizinkan untuk diisi
}
