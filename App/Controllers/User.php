<?php

namespace App\Controllers;

use App\Config;
use App\Model\UserRegister;
use App\Models\Articles;
use App\Utility\Hash;
use App\Utility\Session;
use App\Utility\Cookie;
use \Core\View;
use Exception;
use http\Env\Request;
use http\Exception\InvalidArgumentException;

/**
 * User controller
 */
class User extends \Core\Controller
{

    /**
     * Affiche la page de login
     */
    public function loginAction()
    {
        if(isset($_POST['submit'])){
            $f = $_POST;

            // TODO: Validation

            $this->login($f);

            // Si login OK, redirige vers le compte
            header('Location: /account');
        }

        View::renderTemplate('User/login.html');
    }

    /**
     * Page de création de compte
     */
    public function registerAction()
    {
        if(isset($_POST['submit'])){
            $f = $_POST;

            if($f['password'] !== $f['password-check']){
                // TODO: Gestion d'erreur côté utilisateur
            }

            // validation

            $userId = $this->register($f);

            if ($userId) {
                if ($this->login($f)) {
                    header('Location: /account');
                    exit;
                } else {
                    $_SESSION['error'] = 'La connexion auto ne fonctionne pas.';
                    header('Location: /login');
                    exit;
                }
            }
        }

        View::renderTemplate('User/register.html');
    }

    /**
     * Affiche la page du compte
     */
    public function accountAction()
    {
        $articles = Articles::getByUser($_SESSION['user']['id']);

        View::renderTemplate('User/account.html', [
            'articles' => $articles
        ]);
    }

    /*
     * Fonction privée pour enregister un utilisateur
     */
    private function register($data)
    {
        try {
            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Hash::generateSalt(32);

            $userID = \App\Models\User::createUser([
                "email" => $data['email'],
                "username" => $data['username'],
                "password" => Hash::generate($data['password'], $salt),
                "salt" => $salt
            ]);

            return $userID;

        } catch (Exception $ex) {
            // TODO : Set flash if error : utiliser la fonction en dessous
            /* Utility\Flash::danger($ex->getMessage());*/
        }
    }

    public static function loginWithCookie(){
        
        // On vérifie si l'utilisateur est connecté et s'il a des cookies
        if (Cookie::exists("userId")) {
            $userId = Cookie::get("userId");
            $user = \App\Models\User::getByLogin($userId);
            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                return true;
        }
    }
    return false;
    }

    private function login($data){
        try {
            if(!isset($data['email'])){
                throw new Exception('TODO');
            }

            $user = \App\Models\User::getByLogin($data['email']);

            if (Hash::generate($data['password'], $user['salt']) !== $user['password']) {
                return false;
            }

            $_SESSION['user'] = array(
                'id' => $user['id'],
                'username' => $user['username'],
            );
           
           // Vérifie si l'utilisateur a coché "Se souvenir de moi"
            if (!empty($data['remember-me'])) {
                Cookie::put("userId", $user['id'], (86400 * 7)); // Le cookie expire dans 7 jours 
            }

            return true;

        } catch (Exception $ex) {
            // TODO : Set flash if error
            /* Utility\Flash::danger($ex->getMessage());*/
        }
    }


    /**
     * Logout: Delete cookie and session. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function logoutAction() {

        // Suppression du cookie
        if (Cookie::exists("userId")) {
            Cookie::delete("userId");
        }
        // Nettoyage de la session
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        header ("Location: /");

        return true;
    }

    public function resetAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'];
            $newPassword = $_POST['password'];

            $user = \App\Models\User::getByLogin($email);
            if ($user) {
                $salt = $user['salt'];
                $hashedPassword = Hash::generate($newPassword, $salt);

                if (\App\Models\User::updatePassword($email, $hashedPassword)) {
                    $_SESSION['success'] = 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez vous connecter.';
                    header("Location: /login");
                    exit;
                } else {
                    $_SESSION['error'] = "Erreur lors de la réinitialisation du mot de passe.";
                    header("Location: /reset");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Aucun utilisateur trouvé avec cet email.";
                header("Location: /reset");
                exit;
            }
        } else {
            // Assurez-vous que la session est toujours passée à Twig
            View::renderTemplate('User/reset.html', [
                'session' => $_SESSION
            ]);
            unset($_SESSION['success']);
            unset($_SESSION['error']);
        }
    }

}
