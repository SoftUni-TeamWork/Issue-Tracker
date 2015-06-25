<?php

class IssuesController extends BaseIssuesController
{
    public function all($page)
    {
        $this->getIssues($page);
        $this->title = 'All issues';
        $this->renderView(__FUNCTION__);
    }

    public function details($id)
    {
        $this->issue = $this->db->getIssue($id);
        $this->title = htmlspecialchars($this->issue['title']);
        $this->renderView(__FUNCTION__);
    }

    public function edit($id)
    {
        $this->authorize();

        $this->title = 'Edit';

        $this->issue = $this->db->getIssue($id);
        $this->issueStates = $this->db->getIssueStates();

        if ($this->isPost) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $state_id = $_POST['state-id'];

            $this->db->update($id, $title, $description, $state_id);

            $this->redirect('issues', 'details', [$id]);
        }

        $this->renderView(__FUNCTION__);
    }
}