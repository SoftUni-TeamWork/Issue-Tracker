<?php

class IssuesController extends BaseIssuesController {
    public function all($page){
        $this->getIssues($page);
        $this->title = 'All issues';
        $this->renderView(__FUNCTION__);
    }

    public function details($id) {
        $this->issue = $this->db->getIssue($id);
        $this->title = htmlspecialchars($this->issue['title']);
        $this->renderView(__FUNCTION__);
    }

    public function edit($id) {
        $this->renderView(__FUNCTION__);
    }
}