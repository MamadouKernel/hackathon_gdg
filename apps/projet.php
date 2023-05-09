<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 26/10/2022
 * Time: 22:27
 */

class PROJET
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    /** afficharge de tous les groupes */

    public function affichargeGroup(){
        $groupe = $this->db->select("SELECT * FROM projet");
        return $groupe;
    }

    /**
     * detail groupe
     */

    public function groupe_by_id($id){
        $grp_id = $this->db->select("SELECT * FROM projet WHERE idprojet =?",[$id]);
        return $grp_id;
    }


}