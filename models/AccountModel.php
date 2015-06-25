<?php

class AccountModel extends BaseModel {
    public function register($username, $password) {
        $statement = self::$db->prepare('SELECT COUNT(Id) FROM Users WHERE Username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        
        if ($result['COUNT(Id)']) {
            return false;
        }
        
        $registerStatement = self::$db->prepare('INSERT INTO Users (username, password_hash) VALUES (?, ?)');
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        $registerStatement->bind_param('ss', $username, $passwordHash);
        $isRegisteredSuccesfully = $registerStatement->execute();
        
        return $isRegisteredSuccesfully;
    }
    
    public function login($username, $password) {
        $statement = self::$db->prepare('SELECT id, username, password_hash FROM Users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if(password_verify($password, $result['password_hash'])) {
            return true;
        }

        return false;
    }
}