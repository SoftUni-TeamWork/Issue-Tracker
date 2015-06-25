<?php

class HomeController extends BaseIssuesController {
    public function index() {
        $this->getIssues();
        $this->renderView(__FUNCTION__);
    }
}