<?php

require_once __DIR__ . '../../CONNECT/database.php';
/** Gèrer les connexions des utilisateurs.
 * AUTH
 */
class AUTH
{

    private $membre;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        require_once 'membre.class.php';
        $this->membre = new MEMBRE();
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
     * is_admin
     *
     * @return bool
     */
    public function is_admin(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($this->is_connected()) {
            $result = $this->membre->get_1Membre($this->get_connected_id());
            if ($result) {
                if ($result->idStat == 9) return true;
            }
        }
        return false;
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
        $result = $this->membre->get_AllMembresByEmail($email);
        if ($result) {
            if (password_verify($password, $result[0]->passMemb)) {
                $_SESSION['logged'] = $result[0]->numMemb;
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
