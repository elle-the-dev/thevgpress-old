<?php
class AuthController extends PageController {

    private $requiredPower;
    public function __construct($requiredPower)
    {
        $this->requiredPower = $requiredPower;
        //$this->beforeFilter('@powerCheck');
        Cache::put('user:'.Session::getId(), Auth::user()->id, Config::get('app.chat_timeout'));
    }

    public function powerCheck($route, $request)
    {
        $loggedInUser = Auth::user();
        if (!$loggedInUser->hasPower($this->requiredPower))
            App::abort(403, 'Forbidden');
    }

}
