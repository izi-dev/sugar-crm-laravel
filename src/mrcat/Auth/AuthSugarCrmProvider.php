<?php

namespace MrCat\SugarCrmLaravel\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use MrCat\SugarCrmLaravel\Exception\SugarCrmLaravelException;
use MrCat\SugarCrmOrmApi\Capsule\ManagerSugarCrm;

class AuthSugarCrmProvider implements UserProvider
{

    /**
     * Instance new Manager
     */
    public function service()
    {
        return ManagerSugarCrm::make();
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $this->service()->setSession($identifier);

        return $this->setUser([
            'id' => $identifier,
        ]);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
//        throw new SugarCrmLaravelException('This option remember me is not valid in the provider AuthSugarCrmProvider');
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string                                     $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
//        throw new SugarCrmLaravelException('This option remember me is not valid in the provider AuthSugarCrmProvider');
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $session = $this->service()->login($credentials);
        if ($session->hasSession()) {
            return $this->setUser([
                'id' => $this->service()->get()->getSession(),
            ]);
        }

        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array                                      $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return array_key_exists('username', $credentials) && array_key_exists('password', $credentials);
    }

    /**
     * Set user
     *
     * @param $data
     * @return User
     */
    public function setUser($data)
    {
        $user = new User($data);
        return $user;
    }
}