<?php

    namespace App\Filters;

    use CodeIgniter\Filters\FilterInterface;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;

    class AuthFilter implements FilterInterface
    {
        /**
         * Do whatever processing this filter needs to do.
         * By default it should not return anything during
         * normal execution. However, when an error is found,
         * it may return an instance of ResponseInterface
         * or a string, to modify any subsequent processing
         * of the request.
         *
         * @param RequestInterface $request
         * @param array|null       $arguments
         *
         * @return ResponseInterface|void
         */
        public function before(RequestInterface $request, $arguments = null)
        {
            // Check if the user is logged in
            // If not logged in, redirect them to the login page
            if (! session()->get('isLoggedIn')) {
                // Set a flashdata message for the user
                session()->setFlashdata('error', 'You must be logged in to access that page.');
                // Redirect to the login page
                return redirect()->to('/login');
            }

            // If you want to check for a specific role within the filter, you could do it here
            // For example, to ensure only Project Managers can access the dashboard:
            // if (session()->get('userRole') != 1) { // Assuming role_id 1 is Project Manager
            //     session()->setFlashdata('error', 'Access denied. You do not have permission.');
            //     return redirect()->to('/login'); // Or to an unauthorized page
            // }
        }

        /**
         * We don't need any processing after the controller for this basic auth filter.
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
    