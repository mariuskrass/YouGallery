<?php

require_once '../lib/Repository.php';
require_once '../repository/UserLikesPictureRepository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class PictureRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'picture';

    public function doUpload($pictureName, $userId)
    {    	
        $query = "INSERT INTO $this->tableName (name, user_id) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $pictureName, $userId);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function readFeed($userId)
    {
        $userLikesPictureRepository = new UserLikesPictureRepository();

        $query = "SELECT u.id, u.username, u.profile_picture, p.id, p.name, p.upload_date FROM user_follows_user ufu
            LEFT JOIN picture AS p ON p.user_id = ufu.user2_id
            LEFT JOIN user AS u ON u.id = ufu.user2_id
            WHERE ufu.user1_id = ?
            ORDER BY p.upload_date DESC;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        foreach($rows as $row){
            $row->isLiked = $userLikesPictureRepository->isLiked($row->id, $userId);
        }

        return $rows;
    }

    public function readAllByUserId($userId){
        $query = "SELECT id, name, upload_date FROM $this->tableName WHERE user_id = ? ORDER BY upload_date DESC";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result){
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }
}
