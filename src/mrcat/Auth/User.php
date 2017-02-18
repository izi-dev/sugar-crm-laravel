<?php

namespace MrCat\SugarCrmLaravel\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * primary key user
     */
    protected $primaryKey = 'id';

    /**
     * identifier field user
     */
    protected $identifier_field = 'id';

    /**
     * attributes user
     */
    protected $attributes = [];

    protected $crmId;

    /**
     * Get user attributes
     *
     * @return string
     */
    public function getUserAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->identifier_field;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->attributes[$this->identifier_field];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {

    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {

    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {

    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {

    }

    /**
     * Generates the attributes of the User class
     *
     * @param $attributes
     */
    public function makeAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * SuiteCrm constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Dynamically retrieve attributes on the User model.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
    }

    /**
     * Dynamically set attributes on the User model.
     *
     * @param  string $key
     * @param  mixed $value
     *
     * @return void
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getCrmId()
    {
        return $this->crmId;
    }

    public function setCrmId($crmId)
    {
        $this->crmId = $crmId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}