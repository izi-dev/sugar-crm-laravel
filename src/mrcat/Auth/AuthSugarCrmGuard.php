<?php
namespace MrCat\SugarCrmLaravel\Auth;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;

class AuthSugarCrmGuard extends SessionGuard
{
    /**
     * AuthSugarCrmGuard constructor.
     */
    public function __construct(UserProvider $provider,
                                SessionManager $session,
                                Request $request = null)
    {
        $this->name = 'sugar_crm';
        $this->session = $session;
        $this->request = $request;
        $this->provider = $provider;
    }
}