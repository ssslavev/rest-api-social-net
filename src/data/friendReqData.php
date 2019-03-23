<?php

class FriendReqData {

    public function sendFriendReq($loggedUserId, $id, $loggedUserName) {
        
        $sql = "INSERT  INTO friendreq (from_user, to_user, from_name) VALUES (:from_user, :to_user, :from_name)";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':from_user', $loggedUserId);
            $stmt->bindParam(':to_user', $id);
            $stmt->bindParam(':from_name', $loggedUserName);
    
            $stmt->execute();
            
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getFromReq($loggedUserId, $id) {

        $sql = "SELECT friend_req_id  FROM friendreq  WHERE from_user =:from_user AND to_user=:to_user";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':from_user', $loggedUserId);
            $stmt->bindParam(':to_user', $id);
            $stmt->execute();

            $request =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $request;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getToReq($loggedUserId, $id) {

        $sql = "SELECT friend_req_id  FROM friendreq  WHERE from_user =:from_user AND to_user=:to_user";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':from_user', $id);
            $stmt->bindParam(':to_user', $loggedUserId);
            $stmt->execute();

            $request =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $request;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function acceptReq($loggedUserId, $id) {

        $sql = "INSERT  INTO friends (user_id, friend_id) VALUES (:user_id, :friend_id)";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $loggedUserId);
            $stmt->bindParam(':friend_id', $id);
            $stmt->execute();


            
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getFriends($loggedUserId, $id) {

        $sql = "SELECT friends_id  FROM friends  WHERE user_id =:user_one AND friend_id=:user_two
                OR friend_id = :user_two AND user_id = :user_one";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_one', $loggedUserId);
            $stmt->bindParam(':user_two', $id);
            $stmt->execute();

            $friends =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $friends;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getFriendsList($loggedUserId) {
        $sql = "SELECT * FROM users u 
        LEFT JOIN 
        (
        SELECT user_id
        FROM friends 
        WHERE friend_id =:current_user
        UNION 
        SELECT friend_id
        FROM friends 
        WHERE user_id =:current_user) AS USER ON u.user_id = USER.user_id
        WHERE USER.user_id IS NOT NULL";

        try {
            $db = new Db();
            $db = $db->connect();

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':current_user', $loggedUserId);
            $stmt->execute();

            $friends =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $friends;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
            }

    public function getAllRequests($loggedUserId) {
        $sql = "SELECT friend_req_id, from_user, from_name  FROM friendreq  WHERE  to_user=:to_user";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':to_user', $loggedUserId);
            $stmt->execute();

            $request =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $request;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteRequest($loggedUserId, $id) {
        $sql = "DELETE FROM friendreq  WHERE from_user=:from_user AND  to_user=:to_user";

        try {
            $db = new Db();
            $db = $db->connect();
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':to_user', $loggedUserId);
            $stmt->bindParam(':from_user', $id);
            $stmt->execute();

           // $request =  $stmt->fetchAll(PDO::FETCH_OBJ);
            
            //return $request;
                
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}