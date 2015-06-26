<?php

class IssueModel extends BaseModel {
    public function getIssues($page, $pageSize, $issueStateId, $searchQuery) {
        $query = 'SELECT SQL_CALC_FOUND_ROWS i.id, i.title, i.submit_date, u.username, s.state_type
                                        FROM issues as i
                                        INNER JOIN users as u
                                        ON u.id = i.author_id
                                        INNER JOIN states as s
                                        ON s.id = i.state_id';

        if ($issueStateId !== null && $searchQuery !== null) {
            $query .= ' WHERE i.state_id = ? AND i.title LIKE ?';
        } else if ($issueStateId === null && $searchQuery !== null) {
            $query .= ' WHERE i.title LIKE ?';
        } else if ($searchQuery === null && $issueStateId !== null) {
            $query .= ' WHERE i.state_id = ?';
        }

        $query .= ' ORDER BY i.submit_date LIMIT ?, ?';


        $statement = self::$db->prepare($query);

        //todo improve this
        if ($issueStateId === null && $searchQuery === null) {
            $statement->bind_param('ii', $page, $pageSize);
        } else if ($issueStateId !== null && $searchQuery === null) {
            $statement->bind_param('iii', $issueStateId, $page, $pageSize);
        } else if ($issueStateId === null && $searchQuery !== null) {
            $searchQuery = '%' . $searchQuery . '%';
            $statement->bind_param('sii', $searchQuery, $page, $pageSize);
        } else {
            $searchQuery = '%' . $searchQuery . '%';
            $statement->bind_param('isii', $issueStateId, $searchQuery, $page, $pageSize);
        }

        $statement->execute();
        $result = $statement->get_result();

        return [
            'fetched_issues' => $result->fetch_all(MYSQLI_ASSOC),
            'total_issues' => self::$db->query('SELECT FOUND_ROWS()')->fetch_row()[0]
        ];
    }

    public function getIssue($id) {
        $statement = self::$db->prepare('SELECT i.id, i.title, i.description, i.submit_date, u.username, s.state_type
                                        FROM issues as i
                                        INNER JOIN users as u
                                        ON u.id = i.author_id
                                        INNER JOIN states as s
                                        ON s.id = i.state_id
                                        WHERE i.id = ?');

        $statement->bind_param('i', $id);
        $statement->execute();

        $result = $statement->get_result();

        return $result->fetch_assoc();
    }

    public function getIssueStates() {
        $result = self::$db->query('SELECT id, state_type FROM states');

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getIssueComments($id) {
        $statement = self::$db->prepare('SELECT c.id, c.content, c.submit_date, u.username
                                       FROM comments as c
                                       INNER JOIN users as u
                                       ON u.id = c.author_id
                                       WHERE c.issue_id = ?');

        $statement->bind_param('i', $id);
        $statement->execute();

        $result = $statement->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $title, $description, $state_id) {
        $statement = self::$db->prepare('UPDATE issues
                                         SET title = ?, description = ?, state_id = ?
                                         WHERE id = ?');

        $statement->bind_param('ssii', $title, $description, $state_id, $id);
        $isEdited = $statement->execute();

        return $isEdited;
    }
}