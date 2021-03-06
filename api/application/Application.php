<?php
//responsing to client
require_once('ISKombat/ISKombat.php');
require_once("user/User.php");
require_once("db/DB.php");
require_once("lobby/Lobby.php");

class Application {

    function __construct() {
        $db = new DB();
        $this->user = new User($db);
        $this->lobby = new Lobby($db);
        $this->iskombat = new ISKombat($db);
    } 

    /* USER */
    public function login($params) {
        if ($params["login"] && $params["pass"]) {
            return $this->user->login($params["login"], $params["pass"]);
        }
        return false;   
    }

    public function register($params) {
        if ($params["login"] && $params["pass"]) {
            return $this->user->register($params["login"], $params["pass"]);
        }
        return false;
    }

    public function logout($params) {
        if ($params["token"]) {
            return $this->user->logout($params["token"]);
        }
        return false;
    }
    
    /* LOBBY */
    public function getAllUsers($params) {
        if ($params['token']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                return $this->lobby->getLobbyUsers($user->id);
            }
        }
        return false;
    }

    public function isUserChallenged($params) {
        if ($params['id']) {
            return $this->lobby->isUserChallenged($params['id']);
        }
    }

    public function newChallenge($params) {
        if ($params['token'] && $params['id']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                return $this->lobby->newChallenge($user->id, $params['id']);
            }
        }
        return false;
    }

    public function isChallenge($params) {
        if ($params['token']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                return $this->lobby->isChallenge($user->id);
            }
        }
        return false;
    }

    public function isChallengeAccepted($params) {
        if ($params['token']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                return $this->lobby->isChallengeAccepted($user->id);
            }
        }
        return false;
    }

    public function acceptChallenge($params) {
        if ($params['token'] && $params['answer']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                $result = $this->lobby->acceptChallenge($user->id, $params['answer']); 
                if ($params['answer'] === 'yes') {
                    $lobby = $this->lobby->getLobbyInGame($user->id);
                    $this->iskombat->createKombat($lobby->id_user1, $user->id);
                }
                if ($params["answer"] === 'no') {
                    // what to do if 'no'?
                }
                return $result;
            }
        }
        return false;
    }
    /* GAME */
    public function updateBattle($params) {
        if ($params["token"]) {
            $user = $this->user->getUserByToken($params["token"]);
            if ($user) {
                $battle = $this->iskombat->getBattleByUserId($user->id);
                if ($battle) {
                    return $this->iskombat->updateBattle($user->id, $battle);
                }
            }
        }
        return false;
    }

    public function move($params) {
        if ($params["token"]) {
            $user = $this->user->getUserByToken($params["token"]);
            if ($user && $params["direction"]) {
                return $this->iskombat->move(
                    $user->id,           
                    $params['direction'] 
                );
            }
        }
        return false;
    }

    public function hit($params) {
        if ($params["id"] && $params["hitType"]) {
            return $this->iskombat->hit(
                $params['id'],       
                $params['hitType']     
            );
        }
        return false;
    }

    public function setState($params) {
        if ($params["id"] && $params["state"]) {
            return $this->iskombat->setState(
                $params['id'],      
                $params['state']      
            );
        }
        return false;
    }

    public function deleteFighter($params) {
        if ($params['token']) {
            $user = $this->user->getUserByToken($params['token']);
            if ($user) {
                return $this->iskombat->deleteFighter($user->id);
            }
        }
        return false;
    }
}
