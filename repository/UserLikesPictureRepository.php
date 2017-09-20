<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserLikesPictureRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user_likes_picture';

    public function isLiked($pictureId, $userId){
        $query = "SELECT * FROM $this->tableName WHERE picture_id = ? AND user_id = ?";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $pictureId, $userId);
        $statement->execute();
        
        $result = $statement->get_result();
        $object = $result->fetch_object();

        if ($object !== null){
            return true;
        }else{
            return false;
        }
    }   

    public function like($pictureId, $userId){
        if (!$this->isLiked($pictureId, $userId)){
            $query = "INSERT INTO $this->tableName (user_id, picture_id) VALUES(?, ?)";
        
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('ii', $userId, $pictureId);
            
            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
        }else{
            $query = "DELETE FROM $this->tableName WHERE $userId = ? AND $pictureId = ?";
            
                $statement = ConnectionHandler::getConnection()->prepare($query);
                $statement->bind_param('ii', $userId, $pictureId);
                
                if (!$statement->execute()) {
                    throw new Exception($statement->error);
                }
        }
    }
}