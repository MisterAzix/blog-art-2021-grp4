<?php

/** Gèrer les connexions des utilisateurs.
 * AUTH
 */
class AUTH
{

    private $user;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        require_once 'membre.class.php';
        $this->user = new MEMBRE();
    }

    /**
     * is_connected
     *
     * @return bool
     */
    public function is_connected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['logged']);
    }

    /**
     * get_connected_id
     *
     * @return void
     */
    public function get_connected_id()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['logged'];
    }
    
    /**
     * login
     *
     * @param  string $email
     * @param  string $password
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $result = $this->user->get_1UserByEmail($email);
        if ($result) {
            if (password_verify($password, $result->password)) {
                $_SESSION['logged'] = $result->id;
                return true;
            }
        }
        return false;
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['logged']);
    }
}
