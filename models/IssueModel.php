<?php

class IssueModel extends BaseModel
{
    public function getIssues($page, $pageSize)
    {
        $statement = self::$db->prepare('SELECT SQL_CALC_FOUND_ROWS i.id, i.title, i.submit_date, u.username, s.state_type
                                        FROM issues as i
                                        INNER JOIN users as u
                                        ON u.id = i.author_id
                                        INNER JOIN states as s
                                        ON s.id = i.state_id
                                        ORDER BY i.submit_date
                                        LIMIT ?, ?');
        $statement->bind_param('ii', $page, $pageSize);
        $statement->execute();
        $result = $statement->get_result();

        return [
            'fetched_issues' => $result->fetch_all(MYSQLI_ASSOC),
            'total_issues' => self::$db->query('SELECT FOUND_ROWS()')->fetch_row()[0]
        ];
    }

    public function getIssue($id)
    {
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

    public function getIssueStates()
    {
        $result = self::$db->query('SELECT id, state_type FROM states');

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $title, $description, $state_id)
    {
        $statement = self::$db->prepare('UPDATE issues
                                         SET title = ?, description = ?, state_id = ?
                                         WHERE id = ?');

        $statement->bind_param('ssii', $title, $description, $state_id, $id);
        $isEdited = $statement->execute();

        return $isEdited;
    }

    public function createUserAlbum($username, $name, $photosPaths)
    {
        $userStatement = self::$db->prepare('SELECT id FROM users WHERE username = ?');
        $userStatement->bind_param('s', $username);
        $userStatement->execute();
        $userResult = $userStatement->get_result();
        $userId = $userResult->fetch_all(MYSQLI_ASSOC)[0]['id'];

        $createAlbumStatement = self::$db->prepare('INSERT INTO albums (name, user_id) VALUES (?, ?)');
        $createAlbumStatement->bind_param('si', $name, $userId);
        $createAlbumStatement->execute();

        $albumId = $createAlbumStatement->insert_id;

//        $createPhotoStatement = self::$db->prepare('INSERT INTO photos (user_id, image_path, album_id) VALUES (?, ?, ?)');
//        $createPhotoStatement->bind_param('isi', $userId, $photoPath, $albumId);
//
//        self::$db->query('START TRANSACTION');
//
//        foreach ($photosPaths as $photoPath) {
//            $createAlbumStatement->execute();
//        }
//
//        self::$db->query('Commit');

        return $albumId;
    }
}