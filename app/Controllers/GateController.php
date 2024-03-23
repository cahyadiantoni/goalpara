<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WahanaModel;
use App\Models\GateModel;
use App\Models\TransactionModel;
use App\Models\SelectedTransactionModel;
use App\Models\BalanceModel;

class GateController extends BaseController
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
        $gateModel = new GateModel();

        // Ambil data tiket yang memiliki stat = 1 dan tipe = 2(booth) dari database
        $data['gates'] = $gateModel->where('status', 1)
                               ->findAll();


        // Load view for home page with user data
        return view('gate', $data);
    }

    public function gatecek($gateId)
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            // User is not logged in, redirect to login page
            return redirect()->to('/');
        }

        // Get user data from session
        $data['name'] = session()->get('name');
        $data['username'] = session()->get('username');

        // Load model GateModel
        $gateModel = new GateModel();

        // Ambil data tiket yang memiliki stat = 1 dan tipe = 2(booth) dari database
        $gate = $gateModel->find($gateId);

        if (!$gate) {
            // Handle case when gate is not found
            return redirect()->to('/error');
        }

        $data['gate'] = $gate;

        // Load view for home page with user data
        return view('gatecek', $data);
    }

    public function cekgate()
    {
        // Ambil data POST dari form
        $rfidtiket = $this->request->getPost('rfidtiket');
        $gateId = $this->request->getPost('gateId');

        // Load BalanceModel dan WahanaModel
        $balanceModel = new BalanceModel();
        $wahanaModel = new WahanaModel();

        // Lakukan join antara BalanceModel dan WahanaModel berdasarkan kolom id pada BalanceModel dan wahana_id pada WahanaModel
        $result = $balanceModel->select('balance.*')
                            ->join('wahana', 'wahana.id = balance.wahana_id')
                            ->where('balance.tiket', $rfidtiket)
                            ->where('wahana.gate_id', $gateId)
                            ->first();

        if ($result) {
            $balanceId = $result['id']; // Ambil ID dari balance
            $amount = $result['amount'];

            // Jika data ditemukan, lanjutkan dengan operasi lainnya
            if ($amount > 1) {
                // Kurangi amount jika lebih dari 1
                $newAmount = $amount - 1;
                $balanceModel->update($balanceId, ['amount' => $newAmount]);
                $response = [
                    'success' => true,
                    'message' => "Berhasil masuk, saldo tersisa $newAmount",
                    'data' => $result
                ];
            } elseif ($amount > 0) {
                // Hapus row pada tabel balance jika amount kurang dari 1
                $balanceModel->delete($balanceId);
                $response = [
                    'success' => true,
                    'message' => "Berhasil masuk, saldo tersisa 0",
                    'data' => $result
                ];
            } else {
                // Jika amount kurang dari 0 atau tidak ada row, kirim response saldo tidak ada
                $response = [
                    'success' => false,
                    'message' => 'Tidak ada saldo'
                ];
            }
        } else {
            // Jika tidak ada data tiket dengan rfidtiket, kirim response tiket tidak valid
            $response = [
                'success' => false,
                'message' => 'Tidak ada saldo'
            ];
        }

        // Mengembalikan response dalam format JSON
        return $this->response->setJSON($response);
    }
}
