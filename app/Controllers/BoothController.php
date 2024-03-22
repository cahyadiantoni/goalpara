<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WahanaModel;
use App\Models\TransactionModel;
use App\Models\SelectedTransactionModel;
use App\Models\BalanceModel;

class BoothController extends BaseController
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

        // Load model WahanaModel
        $wahanaModel = new WahanaModel();

        // Ambil data tiket yang memiliki stat = 1 dan tipe = 2(booth) dari database
        $data['wahanas'] = $wahanaModel->where('status', 1)
                               ->where('type', 2)
                               ->findAll();


        // Load view for home page with user data
        return view('loket', $data);
    }

    public function submitTransaksi()
    {
        // Ambil data POST dari form
        $rfidtiket = $this->request->getPost('rfidtiket');
        $totalBayar = $this->request->getPost('totalBayar');
        $paymentType = $this->request->getPost('paymentType');
        $refno = $this->request->getPost('refno');
        $phone = $this->request->getPost('phone');
        $wahanas = $this->request->getPost('wahana'); // Ambil data array wahana

        // Validasi data (bisa tambahkan validasi tambahan sesuai kebutuhan)

        // Simpan data transaksi ke dalam tabel transaction menggunakan model
        $transactionModel = new TransactionModel();
        $transactionData = [
            'tiket' => $rfidtiket,
            'total' => $totalBayar,
            'payment_type' => $paymentType,
            'ref_number' => $refno,
            'phone' => $phone
        ];

        $transactionId = $transactionModel->insert($transactionData); // Simpan transaksi dan dapatkan ID transaksi

        if ($transactionId) {
            // Simpan data array wahana ke dalam tabel selected_transaction menggunakan model
            $selectedTransactionModel = new SelectedTransactionModel();
            $selectedTransactionData = [];
            foreach ($wahanas as $wahana) {
                $selectedTransactionData[] = [
                    'transaction_id' => $transactionId,
                    'tiket' => $rfidtiket,
                    'wahana_id' => $wahana['item_id'],
                    'amount' => $wahana['jumlah']
                ];
            }

            $savedSelected = $selectedTransactionModel->insertBatch($selectedTransactionData);

            if ($savedSelected) {
                $balanceModel = new BalanceModel();
                $balanceData = [];
                foreach ($wahanas as $wahana) {
                    $balanceData[] = [
                        'tiket' => $rfidtiket,
                        'wahana_id' => $wahana['item_id'],
                        'amount' => $wahana['jumlah']
                    ];
                }

                $saved = $balanceModel->insertBatch($balanceData);

                if ($saved) {
                    // Jika data berhasil disimpan, kirim respon berhasil
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Transaksi berhasil disimpan']);
                } else {
                    // Jika terjadi kesalahan saat menyimpan data, kirim respon gagal
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data saldo']);
                }
            } else {
                // Jika terjadi kesalahan saat menyimpan data, kirim respon gagal
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data wahana yang dipilih']);
            }
        } else {
            // Jika terjadi kesalahan saat menyimpan transaksi, kirim respon gagal
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan transaksi']);
        }
    }

}
