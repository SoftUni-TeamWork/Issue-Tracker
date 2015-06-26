<?php

class CommentModel extends BaseModel{
    public function addComment($issueId, $username, $comment) {
        $statement = self::$db->prepare('SELECT id FROM users WHERE username = ?');

        $statement->bind_param('s', $username);
        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        if(count($result) < 1) {
            return false;
        }

        $statement = self::$db->prepare('INSERT INTO comments (content, issue_id, author_id)
                                         VALUES (?, ?, ?)');
        $statement->bind_param('sii', $comment, $issueId, $result['id']);
        $statement->execute();

        if($statement->insert_id) {
            $result = self::$db->query("SELECT c.content as comment, c.submit_date, u.username
                                        FROM comments as c
                                        INNER JOIN users as u
                                        ON u.id = c.author_id
                                        WHERE c.id = $statement->insert_id");

            return $result->fetch_assoc();
        }

        return false;
    }
}