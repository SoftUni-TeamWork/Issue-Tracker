<?php

class IssueModel extends BaseModel {
    public function getIssues($page, $pageSize) {
        $statement = self::$db->prepare('SELECT SQL_CALC_FOUND_ROWS i.id, i.title, i.submit_date, u.username
                                        FROM issues as i
                                        INNER JOIN users as u
                                        ON u.id = i.author_id
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

    public function createUserAlbum($username, $name, $photosPaths) {
        $userStatement = self::$db->prepare('SELECT id FROM users WHERE username = ?');
        $userStatement->bind_param('s', $username);
        $userStatement->execute();
        $userResult = $userStatement->get_result();
        $userId = $userResult->fetch_all(MYSQLI_ASSOC)[0]['id'];

        $createAlbumStatement = self::$db->prepare('INSERT INTO albums (name, user_id) VALUES (?, ?)');
        $createAlbumStatement->bind_param('si', $name,$userId);
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