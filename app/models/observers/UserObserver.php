<?php
class UserObserver {

    public function creating($user)
    {
        if (($validate = $user->validate()) === true)
        {
            $user->password = Hash::make(User::hashPassword($user->password));
            unset($user->password_confirmation);
            return true;
        }
        else
        {
            foreach ($validate->toArray() as $field)
            {
                foreach ($field as $message)
                    Messaging::add('errors', $message);
            }
            return false;
        }
    }

    public function updating($user)
    {
        return $user->validate();
    }

}
