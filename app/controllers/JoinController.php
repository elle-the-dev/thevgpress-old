<?php
/**
 * Join controller
 */

/**
 * Registration form for new users
 */
class JoinController extends PageController {

    /**
     * registration form
     */
    public function join()
    {
        $this->layout->title = "Join";
        $this->layout->heading = "Join";
        $this->layout->content = View::make('join');
    }

    /**
     * process registration form
     *
     * @return mixed
     */
    public function joinPost()
    {
        $user = new User(Input::all());
        $user->password_confirmation = Input::get('password_confirmation');
        if (!$user->save())
            return $this->post('join');
        else
        {
            Messaging::add('successes', 'Signup Successful.  Welcome to The VG Press!');
            return $this->post('/');
        }
    }

}
