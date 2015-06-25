<?php

class IssuesController extends BaseIssuesController {
    public function all($page){
        $this->getIssues($page);
        $this->renderView(__FUNCTION__);
    }
}