<?php
/**
 * LoginController class
 */

/**
 * Handle login page and login modal
 */
class LoginController extends PageController {

    /**
     * login page
     */
    public function login()
    {
        $this->layout->title = "Login";
        $this->layout->heading = "Login";
        $this->layout->styles = array('css/login.css');
    }

    /**
     * login from both the login page and modal
     *
     * @return mixed
     */
    public function loginPost()
    {
        $username = Input::get('username');
        $password = User::hashPassword(Input::get('password'));
        $credentials = array('username' => $username, 'password' => $password);

        if (!Auth::attempt($credentials, true))
        {
            Messaging::add('errors.login-errors', 'Login failed');
            return $this->post('login');
        }

        return $this->post('/');
    }

    /**
     * log the user out
     *
     * @return mixed
     */
    public function logout()
    {
        Auth::logout();
        return $this->post();
    }

}
