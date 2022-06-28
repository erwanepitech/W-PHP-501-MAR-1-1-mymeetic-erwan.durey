<?php
include_once('db_connect.php');

class User extends DbConnection {

    private $lastname;
    private $firstname;
    private $email;
    private $birthday;
    private $hobby;
    private $hobby_perso;
    private $genre;
    private $city;
    private $password;
    private $password_user;
    private $id_user;

    public function __construct () {
        parent::__construct();
    }

    public function setLastname ($lastname) {
        $this->lastname = htmlspecialchars(strip_tags(ucfirst(strtolower($lastname))));
    }
    public function getLastname () {
        return $this->lastname;
    }

    public function setFirstname ($firstname) {
        $this->firstname = htmlspecialchars(strip_tags(ucfirst(strtolower($firstname))));
    }
    public function getFirstname () {
        return $this->firstname;
    }

    public function setEmail ($email) {
        $this->email = htmlspecialchars(strip_tags($email));
    }
    public function getEmail () {
        return $this->email;
    }

    public function setBirthday ($birthday) {
        $this->birthday = htmlspecialchars(strip_tags($birthday));
    }
    public function getBirthday () {
        return $this->birthday;
    }

    public function setHobby ($hobby) {
        $this->hobby = $hobby;
    }
    public function GetHobby () {
        return $this->hobby;
    }

    public function setHobby_perso ($hobby_perso) {
        $this->hobby_perso = htmlspecialchars(strip_tags($hobby_perso));
    }
    public function GetHobby_perso () {
        return $this->hobby_perso;
    }

    public function setGenre($genre, $spec) {
        if ($spec) {
            $this->genre = htmlspecialchars(strip_tags($genre));
        } else {
            $this->genre = $genre;
        }
    }
    public function getGenre () {
        return $this->genre;
    }

    public function setCity ($city, $spec) {
        if ($spec) {
            $this->city = htmlspecialchars(strip_tags($city));
        } else {
            $this->city = $city;
        }
    }
    public function getCity () {
        return $this->city;
    }

    public function setPassword ($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function GetPassword () {
        return $this->password;
    }
    
    public function setPassword_user ($password_user) {
        $this->password_user = htmlspecialchars(strip_tags($password_user));
    }
    public function GetPassword_user () {
        return $this->password_user;
    }

    public function set_Id_user ($id_user) {
        $this->id_user = htmlspecialchars(strip_tags($id_user));
    }
    public function get_Id_user () {
        return $this->id_user;
    }

    public function create () {

        try {
            $birthDate = $this->birthday;
            $currentDate = date("d-m-Y");
            $age = date_diff(date_create($birthDate), date_create($currentDate));
            $age = $age->format("%y");

            $pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
            $match = preg_match($pattern, $this->email);

            if ($age < 18) {
                $msg = "Vous devez être majeur pour vous inscrire";
                $json = ["succes" => 0, "msg" => $msg];
                return $json;
            }

            if ($match != true) {
                $msg = "Merci d'entrer une adress email au format correcte";
                $json = ["succes" => 0, "msg" => $msg];
                return $json;
            }

            $sql = "SELECT email FROM user WHERE email = :email";
            $resul = $this->connection->prepare($sql);
            $resul->bindValue(':email', $this->email, PDO::PARAM_STR);
            $resul->execute();
		    $res = $resul->fetch(PDO::FETCH_ASSOC);
            
            if (isset($res['email'])) {
                $email = $res['email'];
                $msg = "Un compte est deja existant avec cette adress email";
                $json = ["succes" => 0, "msg" => $msg];
            } else {

                $sql = "INSERT INTO user (lastname, firstname, email, genre, password, birthday, hobby_perso)
                VALUES (:nom, :prenom, :mail, :genre, :password, :birthday, :hobby_perso);";

                $resultat = $this->connection->prepare($sql);
                $resultat->bindValue(':nom', $this->lastname, PDO::PARAM_STR);
                $resultat->bindValue(':prenom', $this->firstname, PDO::PARAM_STR);
                $resultat->bindValue(':mail', $this->email, PDO::PARAM_STR);
                $resultat->bindValue(':genre', $this->genre, PDO::PARAM_STR);
                $resultat->bindValue(':password', $this->password, PDO::PARAM_STR);
                $resultat->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
                $resultat->bindValue(':hobby_perso', $this->hobby_perso, PDO::PARAM_STR);
                $resultat->execute();

                for ($i = 0; $i < count($this->hobby); $i++){
                
                    $hobbies = $this->hobby[$i];

                    $sql = "INSERT INTO user_hobby (id_user, id_hobby)
                    SELECT user.id, hobby.id FROM user, hobby
                    WHERE user.email = :email AND hobby.id = :hobby";

                    $bV = $this->connection->prepare($sql);
                    $bV->bindValue(':email', $this->email, PDO::PARAM_STR);
                    $bV->bindValue(':hobby', $hobbies, PDO::PARAM_STR);
                    $bV->execute();
                }

                $sql = "INSERT INTO city_user (id_user, id_city)
                SELECT user.id, city.id FROM user, city
                WHERE user.email=:email AND city.id = :id_city;";

                $resultat = $this->connection->prepare($sql);
                $resultat->bindValue(':email', $this->email, PDO::PARAM_STR);
                $resultat->bindValue(':id_city', $this->city, PDO::PARAM_STR);
                $resultat -> execute();

                $msg = "Votre compte à bien été créée";
                $json = ["succes" => 1, "msg" => $msg];
            }
            return $json;
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $json = ["succes" => 0, "msg" => $msg];
            return $json;
        }
        
    }

    public function check_login () {

        try {
            $pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
            $match = preg_match($pattern, $this->email);
            
            if ($match != true) {
                $msg = "Merci d'entrer une adress email au format correcte";
                $json = ["succes" => 0, "msg" => $msg];
                return $json;
            }

            $sql = "SELECT email, password, id FROM user WHERE email = :email";
            $resul = $this->connection->prepare($sql);
            $resul->bindValue(':email', $this->email, PDO::PARAM_STR);
            $resul->execute();
		    $res = $resul->fetch(PDO::FETCH_ASSOC);
            
            if (isset($res['email'])) {
                $password = $res['password'];
                $email = $res['email'];
                $id = $res['id'];
                $auth = password_verify($this->password_user, $password);
                if ($auth) {
                    $msg = "Le mot de passe est valide !";
                    $json = ["succes" => 1, "msg" => $msg, "user_id" => $id];
                } else {
                    $msg = "Le mot de passe est invalide.";
                    $json = ["succes" => 0, "msg" => $msg];
                }
            } else {
                $msg = "Aucun compte associer a cette adresse email";
                $json = ["succes" => 0, "msg" => $msg];
            }
            return $json;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $json = ["succes" => 0, "msg" => $msg];
            return $json;
        }
    }

    public function read ($id_user) {

        try {
            $sql = "SELECT *
            FROM `user`
            INNER JOIN user_hobby ON user_hobby.id_user = user.id
            INNER JOIN hobby ON hobby.id = user_hobby.id_hobby
            INNER JOIN city_user ON city_user.id_user = user.id
            INNER JOIN city ON city.id = city_user.id_city
            WHERE user.id = :id";

            $resul = $this->connection->prepare($sql);
            $resul->bindValue(':id', $id_user, PDO::PARAM_STR);
            $resul->execute();
            $res = $resul->fetchAll(PDO::FETCH_ASSOC);
            
            if ($res[0]["genre"] == 1) {
                $genre = "homme";
            } elseif ($res[0]["genre"] == 2) {
                $genre = "femme";
            } else {
                $genre = "autres";
            }

            $birthDate = $res[0]['birthday'];
            $currentDate = date("d-m-Y");
            $age = date_diff(date_create($birthDate), date_create($currentDate));
            $age = $age->format("%y");

            $user = [
                "lastname" => $res[0]['lastname'],
                "firstname" => $res[0]['firstname'],
                "email" => $res[0]['email'],
                "birthday" => $age,
                "city" => $res[0]['name'],
                "id_city" => $res[0]['id_city'],
                "genre" => $genre
            ];
            $json = ["succes" => 1, "user" => $user];
            return $json;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $json = ["succes" => 0, "msg" => $msg];
            return $json;
        }
    }

    public function update () {
        
        try {
            $pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
            $match = preg_match($pattern, $this->email);
            
            if ($match != true) {
                $msg = "Merci d'entrer une adress email au format correcte";
                $json = ["succes" => 0, "msg" => $msg];
                return $json;
            }
            
            $sql = "SELECT email FROM user WHERE email = :email";
            $resul = $this->connection->prepare($sql);
            $resul->bindValue(':email', $this->email, PDO::PARAM_STR);
            $resul->execute();
		    $res = $resul->fetch(PDO::FETCH_ASSOC);
            
            if (isset($res['email'])) {
                $email = $res['email'];
                $msg = "Un compte est deja existant avec cette adress email";
                $json = ["succes" => 0, "msg" => $msg];
                return $json;
                
            } else {

                $sql = "SELECT email, password FROM user WHERE id = :id";
                $resul = $this->connection->prepare($sql);
                $resul->bindValue(':id', $this->id_user, PDO::PARAM_STR);
                $resul->execute();
		        $res = $resul->fetch(PDO::FETCH_ASSOC);

		        $password = $res['password'];
		        $email = $res['email'];

                $auth = password_verify($this->password_user, $password);

                if ($auth) {
                    $msg = "Le mot de passe est valide !";
                    $succes = 1;

                    if (isset($this->password)) {
                        $sql = "UPDATE `user`
                        SET
                        `lastname` = :nom,
                        `firstname` = :prenom,
                        `email` = :mail,
                        `password` = :pass
                        WHERE id = :id;";

                        $resultat = $this->connection->prepare($sql);
                        $resultat->bindValue(':nom', $this->lastname, PDO::PARAM_STR);
                        $resultat->bindValue(':prenom', $this->firstname, PDO::PARAM_STR);
                        $resultat->bindValue(':mail', $this->email, PDO::PARAM_STR);
                        $resultat->bindValue(':pass', $this->password, PDO::PARAM_STR);
                        $resultat->bindValue(':city', $this->city, PDO::PARAM_STR);
                        $resultat->bindValue(':id', $this->id_user, PDO::PARAM_STR);
                        $resultat -> execute();

                        $sql = "UPDATE `city_user`
                        SET
                        `id_city` = :city
                        WHERE id_user = :id;";

                        $resultat = $this->connection->prepare($sql);
                        $resultat->bindValue(':city', $this->city, PDO::PARAM_STR);
                        $resultat->bindValue(':id', $this->id_user, PDO::PARAM_STR);
                        $resultat -> execute();

                        $msg = "votre mot de passe à bien été mise a jour";
                        $succes = 1;
                    } else {
                        $sql = "UPDATE `user` 
                        SET
                        `lastname` = :nom,
                        `firstname` = :prenom,
                        `email` = :mail
                        WHERE id = :id";

                        $resultat = $this->connection->prepare($sql);
                        $resultat->bindValue(':nom', $this->lastname, PDO::PARAM_STR);
                        $resultat->bindValue(':prenom', $this->firstname, PDO::PARAM_STR);
                        $resultat->bindValue(':mail', $this->email, PDO::PARAM_STR);
                        $resultat->bindValue(':id', $this->id_user, PDO::PARAM_STR);
                        $resultat -> execute();

                        $sql = "UPDATE `city_user`
                        SET
                        `id_city` = :city
                        WHERE id_user = :id;";

                        $resultat = $this->connection->prepare($sql);
                        $resultat->bindValue(':city', $this->city, PDO::PARAM_STR);
                        $resultat->bindValue(':id', $this->id_user, PDO::PARAM_STR);
                        $resultat -> execute();
                        $msg = "votre compte à bien été mise a jour";
                        $succes = 1;
                    }
                    $json = ["succes" => $succes, "msg" => $msg];
                    return $json;
                } else {
                    $msg = "Le mot de passe est invalide.";
                    $json = ["succes" => 0, "msg" => $msg];
                    return $json;
                }
            }
            return $json;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $json = ["succes" => 0, "msg" => $msg];
            return $json;
        }
    }

    public function search () {

        try {
            if ($this->birthday === "1") {
                $age = "TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 18 AND 25";
            } elseif ($this->birthday === "2") {
                $age = "TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 25 AND 35";
            } elseif ($this->birthday === "3") {
                $age = "TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 35 AND 45";
            } elseif ($this->birthday === "4") {
                $age = "TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 45";
            }

            $genre = implode(',',$this->genre);
            $genre = "(".$genre.")";
            $city = implode(',',$this->city);
            $city = "(".$city.")";
            $hobby = implode(" OR user_hobby.id_hobby=",$this->hobby);
            $hobby = "user_hobby.id_hobby=".$hobby;

            $sql = "SELECT user.id, COUNT(user_hobby.id_user) 
            AS 'Nb hobby' FROM user 
            INNER JOIN user_hobby ON user_hobby.id_user = user.id
            INNER JOIN hobby ON hobby.id = user_hobby.id_hobby
            INNER JOIN city_user ON city_user.id_user = user.id
            INNER JOIN city ON city.id = city_user.id_city
            WHERE user.genre IN $genre AND city_user.id_city IN $city AND $hobby AND $age
            GROUP BY user.id";

            $bV = $this->connection->prepare($sql);
            $bV->execute();
            $row = $bV->fetchALL();
            $id = [];

            for($i=0;$i<count($row);$i++){
                if($row[$i]['Nb hobby'] === strval(count($this->hobby))){
                    array_push($id, $row[$i]['id']);
                }
            }

            $search = [];

            for($i=0;$i<count($id);$i++){
                $sql = "SELECT firstname, lastname, birthday, genre, city.name AS city, hobby.name AS hobby
                FROM `user`
                INNER JOIN user_hobby ON user_hobby.id_user = user.id
                INNER JOIN hobby ON hobby.id = user_hobby.id_hobby
                INNER JOIN city_user ON city_user.id_user = user.id
                INNER JOIN city ON city.id = city_user.id_city
                WHERE user.id = :id";
    
                $resul = $this->connection->prepare($sql);
                $resul->bindValue(':id', $id[$i], PDO::PARAM_STR);
                $resul->execute();
                $res = $resul->fetchAll(PDO::FETCH_ASSOC);
                $hobby = [];

                for($y=0;$y<count($res);$y++){
                    array_push($hobby, $res[$y]["hobby"]);
                }

                $birthDate = $res[0]['birthday'];
                $currentDate = date("d-m-Y");
                $age = date_diff(date_create($birthDate), date_create($currentDate));
                $age = $age->format("%y");

                if ($res[0]['genre'] == 1) {
                    $genre = "Homme";
                } elseif ($res[0]['genre'] == 2) {
                    $genre = "Femme";
                } else {
                    $genre = "Autres";
                }

                $user = [
                    "lastname" => $res[0]['lastname'],
                    "firstname" => $res[0]['firstname'],
                    "age" => $age,
                    "city" => $res[0]['city'],
                    "genre" => $genre,
                    "hobby" => $hobby
                ];

                array_push($search, $user);
            }
            $json = ["user" => $search];
            return $json;

        } catch (Exception $e) {
            $msg = $e->getMessage();
            $json = ["succes" => 0, "msg" => $msg];
            return $json;
        }
    }
}