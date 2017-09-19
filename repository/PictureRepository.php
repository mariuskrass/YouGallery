<?php

require_once '../lib/Repository.php';

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

    public function readAllWithUserName()
    {
        $query = "SELECT p.id, p.name, p.upload_date, u.id, u.username, u.profile_picture FROM {$this->tableName} as p LEFT JOIN user as u on u.id = p.user_id ORDER BY p.upload_date DESC";

        $statement = ConnectionHandler::getConnection()->prepare($query);
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
