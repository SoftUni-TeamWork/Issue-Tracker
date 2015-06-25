<?php

abstract class BaseIssuesController extends BaseController {
    protected $db;

    public function onInit() {
        $this->db = new IssueModel();
    }

    protected function getIssues($page = 1, $pageSize = 6) {
        $from = ($page - 1) * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;

        $albumsData = $this->db->getIssues($from, $pageSize);
        $this->issues = $albumsData['fetched_issues'];
        $this->totalPages = ceil($albumsData['total_issues'] / $this->pageSize);
    }
}