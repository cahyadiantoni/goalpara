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

    public function gateValidation()
    {
        // Ambil idgate dan qrcode dari URL
        $idgate = $this->request->getVar('idgate');
        $qrcode = $this->request->getVar('qrcode');

        // Load model yang diperlukan
        $balanceModel = new BalanceModel();
        $wahanaModel = new WahanaModel();

        // // Lakukan query untuk menggabungkan data

        $saldoWahana = $balanceModel->select('balance.*')
            ->join('wahana', 'wahana.id = balance.wahana_id')
            ->where('balance.tiket', $qrcode)
            ->where('wahana.gate_id', $idgate)
            ->first();

        // Periksa apakah ada data yang ditemukan
        if ($saldoWahana) {
            $balanceId = $saldoWahana['id'];
            $saldo = $saldoWahana['amount'];
            if ($saldo > 1) {
                // Kurangi amount jika lebih dari 1
                $newAmount = $saldo - 1;
                $balanceModel->update($balanceId, ['amount' => $newAmount]);
                return "@*kodegate=$qrcode*saldo=$newAmount*buka=1#";
            } elseif ($saldo > 0) {
                // Hapus row pada tabel balance jika amount kurang dari 1
                $balanceModel->delete($balanceId);
                return "@*kodegate=$qrcode*saldo=0*buka=1#";
            } else {
                // Jika amount kurang dari 0 atau tidak ada row, kirim response saldo tidak ada
                return "@*kodegate=$qrcode*saldo=0*buka=0#";
            }
        } else {
            // Kirim respons JSON kosong jika tidak ada data yang ditemukan
            return "@*kodegate=$qrcode*saldo=0*buka=0#";
        }
    }
}
