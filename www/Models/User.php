<?php
namespace App\Models;
use App\Core\Sql;

class User extends Sql {

    protected Int $id = 0;
    protected String $firstname;
    protected String $lastname;
    protected String $country;
    protected String $email;
    protected String $token;
    protected String $password;
    protected Int $status = 0;
    protected Int $role = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param Int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return String
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param String $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtoupper(trim($country));
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDateInserted()
    {
        return $this->date_inserted;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    public function verifPwd($password): bool
    {
        return password_verify($password,$this->getPassword());
    }

    public function generateToken(): string
    {
       return $token = substr(md5(uniqid().rand(1000000, 9999999)),0,9);

    }


}