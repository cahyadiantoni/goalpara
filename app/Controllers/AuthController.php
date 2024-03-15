<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuthModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Load view for login page
        return view('login');
    }

    public function login()
    {
        // Get input data from form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Load AuthModel
        $authModel = new AuthModel();

        // Attempt authentication
        $user = $authModel->authenticate($username, $password);

        if ($user) {
            // Authentication successful, set session data or redirect to dashboard
            // For example, setting session data:
            session()->set('user_id', $user['id']);
            session()->set('name', $user['name']);
            session()->set('username', $user['username']);
            session()->set('role_id', $user['role_id']);

            // Redirect to dashboard or any other page
            return redirect()->to('/home');
        } else {
            // Authentication failed, redirect back to login page with error message
            return redirect()->to('/')->with('error', 'Invalid username or password.');
        }
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/');
    }
}
