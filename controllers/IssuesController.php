<?php

class IssuesController extends BaseIssuesController {
    public function all($page = 1, $pageSize = 6) {
        $stateId = $_GET['state'];
        $query = $_GET['query'];
        $this->getIssues($page, $pageSize, $stateId, $query);
        $this->title = 'All issues';
        $this->renderView(__FUNCTION__);
    }

    public function details($id) {
        $this->issue = $this->db->getIssue($id);
        $this->comments = $this->db->getIssueComments($id);
        $this->title = htmlspecialchars($this->issue['title']);
        $this->renderView(__FUNCTION__);
    }

    public function edit($id) {
        $this->authorize();

        $this->title = 'Edit';

        $this->issue = $this->db->getIssue($id);
        $this->issueStates = $this->db->getIssueStates();

        if ($this->isPost) {
            $this->validateCsft();
            $title = $_POST['title'];
            $description = $_POST['description'];
            $state_id = $_POST['state-id'];

            $this->db->update($id, $title, $description, $state_id);

            $this->redirect('issues', 'details', [$id]);
        }

        $this->renderView(__FUNCTION__);
    }
}