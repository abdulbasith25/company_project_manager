<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    /**
     * Displays the login form.
     *
     * @return string The rendered login view.
     */
    public function loginForm(): string
    {
        return view('auth/login');
    }

    /**
     * Handles the login attempt.
     * Validates credentials and logs the user in if successful.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse|string A redirect response on success,
     * or the login form with errors on failure.
     */
    public function login()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            $session->setFlashdata('error', 'Please enter both email and password.');
            return redirect()->back()->withInput();
        }

        $user = $userModel->getUserByCredentials($email, $password);

        if ($user && $user['status'] == 1) {
            $session->set([
                'isLoggedIn' => true,
                'userId'     => $user['id'],
                'userName'   => $user['name'],
                'userEmail'  => $user['email'],
                'userRole'   => $user['role_id'],
            ]);

            switch ($user['role_id']) {
                case 1: 
                    return redirect()->to('/admin/dashboard');
                    break;
                case 2: 
                    return redirect()->to('/dashboard/employee');
                    break;
                case 3: // HR
                    return redirect()->to('/hr/dashboard'); 
                    break;
                default:
                    return redirect()->to('/dashboard/general');
                    break;
            }

        } else {
            $session->setFlashdata('error', 'Invalid email/password or your account is inactive.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Logs out the current user by destroying the session.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse A redirect response to the login page.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /**
     * Generic dashboard dispatcher (kept for General, others have their own controllers now).
     *
     * @return string|\CodeIgniter\HTTP\RedirectResponse The rendered dashboard view or a redirect.
     */
    public function dashboard()
    {
        $userRole = session()->get('userRole');
        $userName = session()->get('userName');

        $data = ['userName' => $userName];

        switch ($userRole) {
            case 1:
                return redirect()->to('/admin/dashboard');
                break;
            case 2:
                return redirect()->to('/dashboard/employee');
                break;
            case 3:
                return redirect()->to('/hr/dashboard');
                break;
            default:
                return view('dashboards/general', $data);
                break;
        }
    }

    /**
     * Displays the user registration form.
     *
     * @return string The rendered registration view.
     */
    public function registerForm(): string
    {
        return view('auth/register', [
            'validation' => service('validation')
        ]);
    }

    /**
     * Handles the user registration submission.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function register()
    {
        $session = session();
        $userModel = new UserModel();
        $validation = service('validation');

        $rules = [
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'phone'     => 'permit_empty|max_length[20]',
            'password'  => 'required|min_length[6]',
            'pass_confirm' => 'required_with[password]|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'),
            'role_id'   => 2, 
            'status'    => 1, 
        ];

        if ($userModel->insert($data)) {
            $session->setFlashdata('success', 'Registration successful! You can now log in.');
            return redirect()->to('/login');
        } else {
            log_message('error', 'User registration failed: ' . json_encode($userModel->errors()));
            $session->setFlashdata('error', 'Registration failed. Please try again.');
            return redirect()->back()->withInput();
        }
    }
}
