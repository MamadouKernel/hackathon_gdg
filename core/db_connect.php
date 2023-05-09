<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 09/10/2022
 * Time: 15:29
 */

class database
{

    //put your code here

    private $host = 'localhost';
    private $dbase = 'hackathon';
    private $user = 'root';
    private $password = '';
    private $db;

    public function __construct($host = null, $user = null, $password = null, $dbase = null) {
        if ($host != 0) {
            $this->host = $host;
            $this->dbase = $dbase;
            $this->user = $user;
            $this->password = $password;
        }
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbase", $this->user, $this->password);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES UTF8');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print 'ERREUR DE CONNEXION AU SYSTEME! ' . $e->getMessage();
            exit();
        }
    }

    /**
     * Fonction d'execution des requetes d'insertion
     */
    public function insert($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        return $req->execute($data);
    }

    /*
     * compte
     */

    public function count($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->rowCount();
    }

    public function select($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    public function show($sql, $data = array()) {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        $req->rowCount();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}