<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 14/11/2022
 * Time: 20:40
 */

require'loader.php';

if(isset($_GET['id'])){
    extract($_GET);

    $groupe = $projets->groupe_by_id($id);
}

$reponse = '';

if(isset($_POST['vote'])){
    extract($_POST);



//    $verif_vote = $votes->verif_votant($idvotant);

    $date = date("d/m/Y");

    $verif_vote =$votes->vote_jour($idvotant,$date);

    if($verif_vote != 0){
        $reponse .= 'echec';
    }else{
        $ins_vote = $votes->ins_vote($idvotant,$idprojet,$date);

        if($ins_vote == true){
            $reponse .= 'succes';
        }else{
            $reponse .= 'no_succes';
        }
    }
}
$nb_vote = $votes->nb_vote($_GET['id']);

echo $twig->render('groupe.kmphtml.twig',[
    'groupe_id'=> $groupe[0],
    'session'=> connect(),
    'log_con'=>$votant->_votant_connect(),
    'message'=>$reponse,
    'message_succes'=>'Merci votre voix à bien été prise en compte',
    'message_existe'=> 'Désolé Vous ne pouvez plus vote à la date d\'aujourd\'hui',
    'message_echec'=>'Echec d\'enregistrement veuillez verifier si les informations sont correctes',
    'nb_vote'=>$nb_vote,

]);


function connect(){
    return isset($_SESSION['votant']);
}