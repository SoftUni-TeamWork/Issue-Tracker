<?php

abstract class BaseController {
    protected $controllerName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;
    protected $user;
    protected $isLoggedIn;
    protected $validationError;

    function __construct($controllerName, $actionName) {
        $this->controllerName = $controllerName;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }

        if($_SESSION['username']) {
            $this->isLoggedIn = true;
        }

        $this->onInit();
    }

    public function onInit() {
        // Implement initializing logic in the subclasses
    }

    public function index() {
        // Implement the default action in the subclasses
    }

    public function renderView($viewName = 'index', $includeLayout = true) {
        if (!$this->isViewRendered) {
            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            if ($includeLayout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once($headerFile);
            }
            include_once($viewFileName);
            if ($includeLayout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once($footerFile);
            }
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect($controllerName, $actionName = 'null', $params = null) {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            $encodedParams = array_map(urlencode, $params);
            $url .= '/' . implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    public function getUser(){

    }

    public function authorize() {
        if(!$this->isLoggedIn) {
//            $this->addErrorMessage('Unauthorized');
            $this->redirect('account', 'login');
        }
    }

    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }

    function addValidationError($field, $message) {
        $this->validationError[$field] = $message;
    }

    function getValidationError($field) {
        return $this->validationError[$field];
    }

    protected function validateCsft() {
        $isValid = CsftGuard::validateToken($_POST['CSRFName'], $_POST['CSRFToken']);

        if(!$isValid) {
            $this->redirect("problem", "csrfvalidationfail");
        }
    }
}