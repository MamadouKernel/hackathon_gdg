<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 15/11/2022
 * Time: 05:46
 */

class VOTANT
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** compter le nombre de votant par email */

    public function verif_votant($mail){
        $veri_votant = $this->db->count("SELECT * FROM votant WHERE Email=?",[$mail]);
        return $veri_votant;
    }

    /** compter le nombre de votant */
    public function all_votant(){
        $all_votan = $this->db->count("SELECT * FROM votant");
        return $all_votan;
    }

    /** incription du votant */

    public function ins_votant($np,$tel,$email,$mdp){
        return $this->db->insert("INSERT INTO votant(idvotant,NomPrenom,Tel,Email,motpass) VALUES (?,?,?,?,?)",[null,$np,$tel,$email,$mdp]);
    }

    /** connection du votant */
    public function log_votant($mail,$mdp){
        $log_vot = $this->db->show("SELECT * FROM votant WHERE Email=:mail && motpass=:mdp ",[
            'mail'=>$mail,
            'mdp'=>$mdp
        ]);

        if ($log_vot) {
            $_SESSION['votant']['id'] = $log_vot[0]->idvotant;
            $_SESSION['votant']['nomprenom'] = $log_vot[0]->NomPrenom;
            return TRUE;
        }
        return FALSE;
    }

    /** selectionner le votant connecte */

    public static function votant_id() {
        return $_SESSION['votant']['id'];
    }

    public function _votant_connect() {
        if(isset($_SESSION['votant'])){
            return $this->db->Show("SELECT * FROM votant WHERE   idvotant =" . self::votant_id());
        }
    }


}