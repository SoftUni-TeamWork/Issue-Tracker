<?php

class AccountController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new AccountModel();
        $this->setReturnUrl();
    }

    private function setReturnUrl(){
        if(stripos($_SERVER['HTTP_REFERER'], 'Account') === false) {
           $_SESSION['returnUrl'] = $_SERVER['HTTP_REFERER'];
        }
    }

    private function logoutIfLogged() {
        if($this->isLoggedIn) {
            $_SESSION['returnUrl'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $this->redirect('account', 'logout');
        }
    }

    private function getReturnUrl(){
        if($_SESSION['returnUrl']) {
            return $_SESSION['returnUrl'];
        } else {
            return '/';
        }
    }

    public function register() {
        $this->logoutIfLogged();

        $this->title = "Register";

        if ($this->isPost) {
            $username = $_POST['username'];

            if(!$username || mb_strlen($username) < 3) {
                $this->addErrorMessage('Username is invalid');
                $this->redirect('account', 'register');
            }

            $password = $_POST['password'];
            $isRegistered = $this->db->register($username, $password);

            if ($isRegistered) {
                $_SESSION['username'] = $username;
                $this->redirectToUrl($this->getReturnUrl());
                unset($_SESSION['returnUrl']);
            } else {
                $this->addErrorMessage('Register failed.');
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login() {
        $this->title = 'Login';

        $this->logoutIfLogged();

        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $isLoggedIn = $this->db->login($username, $password);

            if($isLoggedIn) {
                $_SESSION['username'] = $username;
                $this->redirectToUrl($this->getReturnUrl());
                unset($_SESSION['returnUrl']);
            } else {
                $this->addErrorMessage('Login failed');
                $this->redirect('account', 'login');
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function logout() {
        unset($_SESSION['username']);
        $this->redirectToUrl($this->getReturnUrl());
        unset($_SESSION['returnUrl']);
    }
}