<?php
/**
* Implement all the data access object for Carpooling-Rideshare application
* WAP - October 2015
* @author: Bao Pham
*/
      include("db-connection.php");
    /*
    * This function insert a new trip post into the database
    * @return the ID of the new record if successful else return 0
    */
    function addTripPost($triptext, $userid) {
        global $db;
        try {
            $stmt = $db->prepare("INSERT INTO trips(trip_text, user_id, created_date) VALUES (:striptext, :userid, NOW())");
            $db->beginTransaction();
            $stmt->execute(array(':striptext'=>$triptext,
                                 ':userid'=>$userid)); 
            $newid = $db->lastInsertId();
            $db->commit();
            $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t, users as u 
                                WHERE t.user_id = u.user_id
                                AND t.trip_id = :newid
                                ORDER BY t.created_date DESC");
            $stmt->execute(array(':newid'=>$newid));
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas[0];
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }
    }
                                 
    /*
    * This function insert a new comment on each trip post
    * @return the ID of the new record if successful else return 0
    */
    function addComment($commenttext, $userid, $tripid) {
        global $db;
        try {
            $stmt = $db->prepare("INSERT INTO comments(comment_text, user_id, trip_id, created_date) VALUES (:commenttext, :userid, :tripid, now())");
            $db->beginTransaction();
            $stmt->execute(array(':commenttext'=>$commenttext,
                                 ':userid'=>$userid,
                                 ':tripid'=>$tripid)); 
            $newid = $db->lastInsertId();
            $db->commit();
            return $newid;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return 0;
        }
    }
    
    /*
    * This function deletes a trip post
    * @return true if successful else return false;
    */
    function deleteTripPost($tripid) {
        global $db;
        try {
            $stmt = $db->prepare("DELETE FROM trips where trip_id = :tripid");
            $db->beginTransaction();
            $stmt->execute(array(':tripid'=>$tripid)); 
            $db->commit();
            return true;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return false;
        }
         
    }

    /*
    * This function deletes a comment on each trip post
    * @return true if successful else return false;
    */
    function deleteComment($commentid) {
        global $db;
        try { 
            $stmt = $db->prepare("DELETE FROM comments where comment_id = :commentid");
            $db->beginTransaction();
            $stmt->execute(array(':commentid'=>$commentid)); 
            $db->commit();
            return true;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return false;
        }
         
    }
                           
    /*
    * This function makes a trip as a favorite for user
    * @return the ID of the new record if successful else return 0
    */
    function addFavorite($userid, $tripid) {
        global $db;
        try {
            $stmt = $db->prepare("INSERT INTO favorites (user_id, trip_id) VALUES (:userid, :tripid)");
            $db->beginTransaction();
            $stmt->execute(array(':userid'=>$userid,
                                 ':tripid'=>$tripid)); 
            $newid = $db->lastInsertId();
            $db->commit();
            return $newid;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return 0;
        }
    }
                                 
    /*
    * This function deletes a favorite of a trip post for each user
    * @return true if successful else return false;
    */
    function removeFavorite($userid, $tripid) {
        global $db;
        try {
            $stmt = $db->prepare("DELETE FROM favorites where user_id = :userid and trip_id = :tripid");
            $db->beginTransaction();
            $stmt->execute(array(':userid'=>$userid,
                                 ':tripid'=>$tripid)); 
            $db->commit();
            return true;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return false;
        }
         
    }
                                 
    /*
    * This function selects newest 20 trip posts in the database
    * @return fetched data if successful else return null
    */
    function searchNewestTripPost() {
        global $db;
        try {
            $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t, users as u 
                                WHERE t.user_id = u.user_id ORDER by t.created_date DESC LIMIT 20");
            $stmt->execute(array());
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    }  
        
     /*
    * This function selects all trip posts marked as favorite
    * @return fetched data if successful else return null
    */
    function searchFavoritedTripPost() {
        global $db;
        try {
           $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t, users as u, favorites as f
                                WHERE t.user_id = u.user_id AND t.trip_id = f.trip_id
                                AND t.user_id = f.user_id;");
            $stmt->execute(array());
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    }       
      
    /*
    * This function selects all the trip posts based on the keyword
    * @return fetched data if successful else return null
    */
    function searchTripPostByKeyword($keyword) {
        global $db;
        try {
            $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t, users as u 
                                WHERE t.user_id = u.user_id
                                AND t.trip_text LIKE :keyword
                                ORDER BY t.created_date DESC");
            $keyword = "%".$keyword."%";
            $stmt->execute(array(':keyword'=>$keyword));
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    }  
        
        
    /*
    * This function update a comment on each trip post
    * @return true if successful else return 0
    */
    function updateComment($commentid, $commenttext) {
        global $db;
        try {
            $stmt = $db->prepare("UPDATE comments SET comment_text = :commenttext WHERE comment_id = :commentid");
            $db->beginTransaction();
            $stmt->execute(array(':commenttext'=>$commenttext,
                                 ':commentid'=>$commentid)); 
            $db->commit();
            return true;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return false;
        }
    }
        
    /*
    * This function update trip post
    * @return true if successful else return 0
    */
    function updateTripPost($tripid, $triptext) {
        global $db;
        try { 
            $stmt = $db->prepare("UPDATE trips SET trip_text = :triptext WHERE trip_id = :tripid");
            $db->beginTransaction();
            $stmt->execute(array(':triptext'=>$triptext,
                                 ':tripid'=>$tripid)); 
            $db->commit();
            return true;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return false;
        }
    }

    /*
    * This function selects all trip posts
    * @return fetched data if successful else return null
    */
    function getAllTrips() {
        global $db;
        try {
            $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t LEFT JOIN users as u ON t.user_id = u.user_id
                                ORDER BY t.created_date DESC");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    } 
    
    /*
    * This function get comments for each trip
    * @return fetched data if successful else return null
    */
    function getCommentsByTrip($tripid) {
        global $db;
        try {
            $stmt = $db->prepare("SELECT c.*, u.username, u.password, u.email 
                                FROM `comments` as c, users as u, trips as t
                                WHERE c.trip_id = t.trip_id
                                AND t.user_id = t.user_id
                                AND t.trip_id = :tripid");
            $stmt->execute(array(':tripid' => $tripid));
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    } 

    /*
    * This function selects all trip posts
    * @return fetched data if successful else return null
    */
    function getNewTripPost() {
        global $db;
        try {
            $stmt = $db->prepare("SELECT t.*, u.username, u.password, u.email 
                                FROM `trips` as t, users as u 
                                WHERE t.user_id = u.user_id
                                AND TO_SECONDS(t.created_date) > TO_SECONDS(now()) - 30
                                ORDER BY t.created_date DESC");
            $stmt->execute();
            $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datas;
        }
        catch (PDOException $e) {
            print $e-> getMessage();
            return null;
        }    
    } 
?>