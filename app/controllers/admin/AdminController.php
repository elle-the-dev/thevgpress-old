<?php
class AdminController extends PageController {

    private $requiredPower;
    public function __construct($requiredPower)
    {
        $this->requiredPower = $requiredPower;
        $this->beforeFilter('@powerCheck');
    }

    public function powerCheck($route, $request)
    {
        $loggedInUser = Auth::user();
        if (!$loggedInUser->hasPower($this->requiredPower))
            App::abort(403, 'Forbidden');
    }

}
