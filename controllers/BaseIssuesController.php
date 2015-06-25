<?php

abstract class BaseIssuesController extends BaseController
{
    protected $db;

    public function onInit()
    {
        $this->db = new IssueModel();
    }

    protected function getIssues($page = 1, $pageSize = 6, $stateId = null, $query = null)
    {
        $from = ($page - 1) * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;

        $issuesData = $this->db->getIssues($from, $pageSize, $stateId, $query);

        $this->issueStates = $this->db->getIssueStates();
        $this->issues = $issuesData['fetched_issues'];
        $this->totalPages = ceil($issuesData['total_issues'] / $this->pageSize);
    }
}