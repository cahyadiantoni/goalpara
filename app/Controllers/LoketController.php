<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TiketModel;

class LoketController extends BaseController
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

        // Load model TiketModel
        $tiketModel = new TiketModel();

        // Ambil data tiket yang memiliki stat = 1 dari database
        $data['tikets'] = $tiketModel->where('stat', 1)->findAll();

        // Load view for home page with user data
        return view('loket', $data);
    }
}
