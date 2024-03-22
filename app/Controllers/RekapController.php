<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WahanaModel;
use App\Models\TransactionModel;
use App\Models\SelectedTransactionModel;
use App\Models\BalanceModel;

class RekapController extends BaseController
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

        // Load model Transaction
        $transactionModel = new TransactionModel();

        // Ambil data tiket yang memiliki stat = 1 dari database
        $data['transactions'] = $transactionModel->findAll();

        // Load view for home page with user data
        return view('rekap', $data);
    }

}
