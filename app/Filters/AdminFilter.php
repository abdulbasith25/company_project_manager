<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Checks if the user is an admin (role_id = 1).
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return ResponseInterface|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // First, ensure the user is logged in (AuthFilter should ideally run before this one)
        // This check is a safeguard; if AuthFilter is configured to run first, it's redundant here.
        if (! session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'You must be logged in to access that page.');
            return redirect()->to('/login');
        }

        // Check if the logged-in user's role is Admin (role_id = 1)
        if (session()->get('userRole') != 1) {
            session()->setFlashdata('error', 'Access denied. You do not have administrative privileges.');
            return redirect()->to('/dashboard/general'); // Redirect to a general dashboard or an unauthorized page
        }
    }

    /**
     * We don't need any processing after the controller for this filter.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after the controller
    }
}
