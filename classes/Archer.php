<?php

    class Archer extends Character
{
    public $carquois = 5;
    public $prepare = false;

    public function turn($target) {

        if($this->carquois == 0) { //alors archer utilise une dague
            return $this->dague($target);
    
        } elseif ($this->carquois > 0) {//alors archer utilise ses fleches: soit une fleche, soit prepare+deux fleches au tour suivant
            
            $optionsArcher = rand(1, 10);
            //echo $optionsArcher;
            if($optionsArcher < 3) {
                return $this->tireFleche($target);

            } elseif($optionsArcher >= 3 || $this->prepare == false) {
                return $this->tireDeuxFleches($target);
            }
    }
}

    public function tireFleche($target) {
        $target->healthPoints = $target->healthPoints - $this->damage;
        $this->carquois = $this->carquois -1;

        $status = "$this->name tire une fleche sur $target->name. Il reste $target->healthPoints points de vie à $target->name et il reste $this->carquois fleches à $this->name";

        return $status;
}

    public function tireDeuxFleches($target) { //en deux etapes: 1=se preparer et 2=tirer 2 fleches
        if($this->prepare == false) {
            $this->prepare = true;
            $target->turn($this);
            $status = "$this->name prepare son prochain attack, mais $target->name attaque";
            return $status;

        } $this->prepare = false;
            $target->healthPoints = $target->healthPoints - $this->damage * 2;
            $this->carquois = $this->carquois -2;

            $status = "$this->name tire deux fleches sur $target->name. Il reste $target->healthPoints points de vie à $target->name et il reste $this->carquois fleches à $this->name";
            return $status;
    }

    public function dague($target) {
        $dagueDamage = $this->damage / 5;
        $target->setHealthPoints($dagueDamage);

        $status = "$this->name n'a plus de fleches dans son carquois et donne un coup de dague à $target->name. Il reste $target->healthPoints points de vie à $target->name";
        return $status;
    }
}
