<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserCommentsPictureRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user_comments_picture';

    public function comment($pictureId, $userId, $comment){
        $query = "INSERT INTO $this->tableName (user_id, picture_id, comment) VALUES(?, ?, ?)";
    
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iis', $userId, $pictureId, $comment);
        
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}