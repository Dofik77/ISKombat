<?php
// need to make move, setState and hit functions


require_once("Fighter.php");

const STATE = array(
            "STANDING" => "STANDING",
            "CROUCHING" => "CROUCHING",
            "DOWN" => "DOWN",
            "JUMP" => "JUMP"
        );    

const WIDTH = array(  
            "STANDING" => 1,
            "CROUCHING" => 1.5,
            "DOWN" => 5,
            "JUMP" => 1
        );

const HEIGHT = array(  
            "STANDING" => 5,
            "CROUCHING" => 2.5,
            "DOWN" => 1,
            "JUMP" => 10
        );

class ISKombat {
    function __construct() {
        $data = new stdClass();
        $data->{"id"} = 0;
        $data->{"x"} = 0;
        $data->{"y"} = 0;
        $data->{"state"} = STATE["STANDING"];
        $data->{"width"} = WIDTH[$this->state];
        $data->{"height"} = HEIGHT[$this->state];
        //$data->{"hit"} = false;
        //$data->{"hitTimeStamp"} = 0;      // to check time of hit before next hit
        //$data->{"hitType"} = "block";     //(hand, leg or block)
        //$data->{"health"} = 100;
        //$data->{"direction"} = "right";
        //$data->{"movingSpeed"} = 10;      //?
        //$data->{"jumpSpeed"} = 25;        //↓
        //$data->{"jumpAcceleration"} = 50; //to count jumping parabola
        $this->Fighters = array(
                        "Fighter1" => new Fighter($data, $this->state)
                    );
        //scene
        $this->scene = new stdClass();
        $this->scene->left = 0;
        $this->scene->right = 100;

    }
    /*
    // moving fighter
    public function move($id, $direction) {
        if (Fighters->$id) {
            switch ($direction) {
                case "right":
                    if ((Fighters["Fighter1"]->x + Fighters["Fighter1"]->movingSpeed) < scene->right) return "Success";
                    return "error";
                    break;

                case "left":
                    if ((Fighters["Fighter1"]->x + Fighters["Fighter1"]->movingSpeed) > scene->left) return "Success";
                    return "error";
                    break;
            }
        }
    }
    */
    //
    public function setState($id, $STATE) {

    }
    //
    public function hit($id, $hitType) {

    }
    
}