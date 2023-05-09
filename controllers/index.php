<?php

require'loader.php';

//if(!connect()){
//    header('location: http://vote/');
//}


echo $twig->render('index.kmphtml.twig',[

    'groupes'=> $projets->affichargeGroup(),
    'session'=> connect(),
    'log_con'=>$votant->_votant_connect(),

]);


function connect(){
    return isset($_SESSION['votant']);
}