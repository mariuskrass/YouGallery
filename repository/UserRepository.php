<?php

require_once '../lib/Repository.php';
require_once '../repository/PictureRepository.php';
require_once '../repository/UserFollowsUserRepository.php';

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
     public function create($username, $password, $email, $status)
     {
         $password = sha1($password);
         
         $query = "INSERT INTO $this->tableName (username, password, email, status) VALUES (?, ?, ?, ?)";
         
         $statement = ConnectionHandler::getConnection()->prepare($query);
         $statement->bind_param('ssss', $username, $password, $email, $status);
         
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
        $pictureRepository = new PictureRepository();

        $profile->pictures = $pictureRepository->readAllByUserId($userId);

        // get follows
        $userFollowsUserRepository = new UserFollowsUserRepository();

        $profile->followersCount = $userFollowsUserRepository->readFollowersCount($userId);

        return $profile;
    }

    public function readByKeyword($keyword){
        $keyword = "%$keyword%";
        $query = "SELECT id, username, status, profile_picture FROM user
            WHERE username LIKE ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $keyword);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $userFollowsUserRepository = new UserFollowsUserRepository();

        $rows = array();
        while ($row = $result->fetch_object()) {
            $row->followersCount = $userFollowsUserRepository->readFollowersCount($row->id);
            $rows[] = $row;
        }

        return $rows;
    }
}
