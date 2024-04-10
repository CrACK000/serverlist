<?php

require 'vendor/autoload.php';

use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\TooManyRequestsException;

if (!$auth->isLoggedIn()) {

    if (isset($_POST['login'])) {

        try {
            $auth->login($_POST['email'], $_POST['password']);
            // user is logged in
            lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: YES (user is logged in)");
            header('Location: ' . URL . '/admin');
        } catch (InvalidEmailException $e) {
            // wrong email address
            $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Nesprávny Email !</div>';
            lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (wrong email address)");
            header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
        } catch (InvalidPasswordException $e) {
            // wrong password
            $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Špatné heslo !</div>';
            lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (wrong password)");
            header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
        } catch (EmailNotVerifiedException $e) {
            // email not verified
            $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Email nieje overený !</div>';
            lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (email not verified)");
            header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
        } catch (TooManyRequestsException $e) {
            // too many requests
            $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Vyskytla sa chyba !</div>';
            lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (too many requests)");
            header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
        }
    }

} else {

    if (isset($_POST['adminLogout'])) {
        $auth->logOutAndDestroySession();
        header("Location: " . URL . '/index');
    }

}

echo '
<div class="pl-sidebar affix px-5">
    <ul class="nav flex-column">
        
        <li class="nav-item small">
            Navigácia
        </li>

        <li class="nav-item">
            <a class="nav-link" href="' . URL . '/packages">
                <i class="fas fa-archive mr-3 small"></i> Balíčky
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-newspaper mr-3 small"></i> Novinky
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-search mr-3 small"></i> Vyhľadať server
            </a>
        </li>';

        if ($_SERVER['SCRIPT_NAME'] == '/index.php') {
            require 'panel_menu.php';
        }

        if ($auth->isLoggedIn()) {

            if ($auth->hasRole(\Delight\Auth\Role::SUPER_MODERATOR)) {

                echo '
                <li class="nav-item small mt-5">
                    Administrácia
                </li>
        
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=servers">
                        <i class="fas fa-server mr-3 small"></i> Administrácia serverov
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=news">
                        <i class="fas fa-newspaper mr-3 small"></i> Novinky
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=ticket">
                        <i class="fas fa-ticket-alt mr-3 small"></i> Podpora / Tikety
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=system">
                        <i class="fas fa-cogs mr-3 small"></i> Nastavenia systému
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=users">
                        <i class="fas fa-users mr-3 small"></i> Správca užívateľov
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=logs">
                        <i class="fas fa-hashtag mr-3 small"></i> Logy systému
                    </a>
                </li>';

            }

            echo '
    
            <li class="nav-item small mt-5">
                Užívateľ
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-server mr-3 small"></i> Moje servery
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog mr-3 small"></i> Nastavenia
                </a>
            </li>
    
            <li class="nav-item text-center mt-3">
                <form method="post">
                    <button class="nav-link button-sm" name="adminLogout"><i class="fas fa-sign-out-alt mr-1 small"></i> Odhlásiť sa</button>
                </form>
            </li>';

        }

        echo '
    </ul>
</div>';

    /*echo '
    <div class="card">
        <div class="card-header bg-primary text-light border-none">
            Administrácia
        </div>
        <div class="card-body">
            <ul class="nav flex-column">
            
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=servers">Zoznam serverov</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=servers&action=add">Pridať server</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="' . URL . '/admin?page=servers&action=wait">Servery na schválenie</a>
                </li>
                
                <li class="nav-item">
                    <form method="post">
                        <button class="nav-link btn btn-link" name="adminLogout">Odhlásiť sa</button>
                    </form>
                </li>
                
            </ul>
        </div>
    </div>';

} else {

    echo '
    <div class="card">
        <div class="card-header bg-primary text-light border-none">
            Administrácia
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="e">Váš Email</label>
                    <input type="email" name="email" class="form-control" id="e" required="required" placeholder="yourname@example.com">
                </div>
                <div class="form-group">
                    <label for="h">Heslo</label>
                    <input type="password" name="password" class="form-control" id="h" required="required" placeholder="********">
                </div>
                
                <button type="submit" name="login" class="btn btn-light w-100"><i class="fas fa-sign-in-alt mr-2"></i> Prihlásiť sa</button>
                
            </form>
        </div>
    </div>';

}*/