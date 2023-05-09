<?php

require'loader.php';

if(connect()){
    header('location:http://vote/');
}


$reponse = '';

if(isset($_POST['connexion'])){
    extract($_POST);

    if($votant->log_votant($mail,$mdp)){
        $reponse .= 'succes';
    }else{
        $reponse .= 'echec';
    }
}



echo $twig->render('login.kmphtml.twig',[
    'message' => $reponse,
    'message_connexion' => 'Connexion réussie ! le système va vous rediriger !....',
    'message_err_connexion' => 'Echec Vos données d\'ouverture de session sont incorrectes ! Réessayer SVP !',
    'session'=> connect(),
//    'log_con'=>$votant->_votant_connect(),

]);


function connect(){
    return isset($_SESSION['votant']);
}