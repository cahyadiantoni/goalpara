<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends BaseController
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
        $data['role_id'] = session()->get('role_id');

        // Load view for home page with user data
        return view('home', $data);
    }
}
