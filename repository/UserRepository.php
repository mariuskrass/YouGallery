<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($firstName, $lastName, $email, $password)
    {
        $password = sha1($password);

        $query = "INSERT INTO $this->tableName (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $firstName, $lastName, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function follow($user1Id, $user2Id){
        $query = "INSERT INTO user_follows_user (user1_id, user2_id) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $user1Id, $user2Id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readProfile($userId){
        // get user
        $query = "SELECT id, username, status, profile_picture FROM $this->tableName WHERE id = ?;";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $user = $result->fetch_object();

        $profile = new stdClass();
        $profile->id = $user->id;
        $profile->username = $user->username;
        $profile->status = $user->status;
        $profile->profile_picture = $user->profile_picture;

        // get pictures from user
        $query2 = "SELECT id, name, upload_date FROM picture WHERE user_id = ?";

        $statement2 = ConnectionHandler::getConnection()->prepare($query2);
        $statement2->bind_param('i', $userId);
        $statement2->execute();

        $result2 = $statement2->get_result();
        if (!$result2){
            throw new Exception($statement2->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result2->fetch_object()) {
            $rows[] = $row;
        }

        $profile->pictures = $rows;

        // get follows
        $profile->followersCount = $this->readFollowersCount($userId);

        return $profile;
    }

    public function readFollowersCount($userId){
        $query = "SELECT COUNT(*) as followersCount FROM user_follows_user WHERE user2_id = ?;";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $object = $result->fetch_object();
        return $object->followersCount;
    }
}
