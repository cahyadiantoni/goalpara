<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WahanaModel;
use App\Models\TransactionModel;
use App\Models\SelectedTransactionModel;
use App\Models\BalanceModel;

class SaldoController extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            // User is not logged in, redirect to login page
            return redirect()->to('/');
        }

        // Get user data from session
        $data['name'] = session()->get('name');
        $data['username'] = session()->get('username');

        return view('saldo', $data);
    }

    public function ceksaldo()
    {
        // Ambil data POST dari form
        $rfidtiket = $this->request->getPost('rfidtiket');

        // Load model yang diperlukan
        $balanceModel = new BalanceModel();
        $wahanaModel = new WahanaModel();

        // Lakukan query untuk menggabungkan data
        $saldoWahana = $balanceModel->select()
                                    ->join('wahana', 'balance.wahana_id = wahana.id')
                                    ->where('balance.tiket', $rfidtiket)
                                    ->findAll();

        // Periksa apakah ada data yang ditemukan
        if (!empty($saldoWahana)) {
            // Kirim data join melalui Ajax jika ada data yang ditemukan
            return $this->response->setJSON($saldoWahana);
        } else {
            // Kirim respons JSON kosong jika tidak ada data yang ditemukan
            return $this->response->setJSON([]);
        }
    }


}
