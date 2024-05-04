<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WahanaModel;
use App\Models\TransactionModel;
use App\Models\SelectedTransactionModel;
use App\Models\BalanceModel;

class SummaryController extends BaseController
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
    
        // Load WahanaModel data
        $wahanaModel = new WahanaModel();
        $wahanaData = $wahanaModel->findAll();
    
        // Load SelectedTransactionModel data
        $selectedTransactionModel = new SelectedTransactionModel();
        $selectedData = $selectedTransactionModel->findAll();
    
        // Combine data based on wahana_id
        $combinedData = [];
        foreach ($selectedData as $selected) {
            $wahanaId = $selected['wahana_id'];
            $wahana = null;
            foreach ($wahanaData as $wahanaItem) {
                if ($wahanaItem['id'] == $wahanaId) {
                    $wahana = $wahanaItem;
                    break;
                }
            }
            if ($wahana) {
                $totalAmount = $selected['amount'];;
                $totalPrice = $wahana['harga'] * $totalAmount;
                if (!isset($combinedData[$wahanaId])) {
                    $combinedData[$wahanaId] = [
                        'wahana_id' => $wahanaId,
                        'wahana_name' => $wahana['name'],
                        'jumlah_tiket' => $totalAmount,
                        'harga' => $wahana['harga'],
                        'total' => $totalPrice,
                    ];
                } else {
                    $combinedData[$wahanaId]['jumlah_tiket'] += $totalAmount;
                    $combinedData[$wahanaId]['total'] += $totalPrice;
                }
            }
        }

        // Calculate total revenue
        $totalRevenue = array_sum(array_column($combinedData, 'total'));
    
        // Pass combined data to the view
        $data['combinedData'] = $combinedData;
        $data['totalRevenue'] = $totalRevenue;
    
        // Load view for home page with user data and combined data
        return view('summary', $data);
    }
    

}
