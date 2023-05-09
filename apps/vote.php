<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 15/11/2022
 * Time: 13:43
 */

class VOTE
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** compter le nombre de vote par idvotant */

    public function verif_votant($idvotant){
        $veri_vote = $this->db->count("SELECT * FROM vote WHERE vote.idvotant=?",[$idvotant]);
        return $veri_vote;
    }

    /** incription du vote */

    public function ins_vote($idvotant,$idprojet,$date_j){
        return $this->db->insert("INSERT INTO vote(idvote,idvotant,idprojet,date) VALUES (?,?,?,?)",[null,$idvotant,$idprojet,$date_j]);
    }

    /** compter le nombre de vote par projet */

    public function nb_vote($idprojet){
        $nb_vote = $this->db->count("SELECT * FROM vote WHERE vote.idprojet=?",[$idprojet]);
        return $nb_vote;
    }


    /** vote journalier */

    public function vote_jour($idvotant,$date_j){
        $vote_jour = $this->db->count("SELECT * FROM vote WHERE vote.idvotant=? && vote.date=?",[$idvotant,$date_j]);
        return $vote_jour;
    }

}