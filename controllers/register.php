<?php

require'loader.php';

if(connect()){
    header('location:http://vote/');
}

$reponse = '';

if(isset($_POST['inscription'])){
    extract($_POST);

    $verif_votant = $votant->verif_votant($mail);

    if($verif_votant != 0){
        $reponse .= 'echec';
    }else{
        $np = $nom.' '.$prenom;
        $mdp = 'HaCkaDeVYa_'.substr($nom,0,3).substr($prenom,0,1).($votant->all_votant()+1);

        $insert_votant = $votant->ins_votant($np,$tel,$mail,$mdp);

        if($insert_votant == true){
            try{
                $destinataire = "contacts@so-am.org"; // Adresse destinateur
                $emeteur = $mail; // Adresse emeteur
                $no_reply = $mail; // Adresse de retour
                $sujet ="Mot de passe pour votre compte de vote pour l'hackathon"; // Sujet du mail
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'X-Priority : 1' . "\r\n"; // Niveau de priorité : urgent
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
                $headers .= "From: $np <$emeteur>" . "\r\n" . "Reply-To:$no_reply" . "\r\n";
                $messages = "<html>
                                 <head>
                                    <title>VOTANT HACKATHON DEVFEST-CI 2022</title>
                                 </head>
                                 <body>
                                   <p>Gooogle à toi merci pour votre interet à l'election de notre HACKATHON DEVFEST-CI 2022, vos identifiants sont les suivants:</p>
                                   <table>
                                        <tr>
                                           <th>Adresse Mail</th><th>Mot de passe</th>
                                        </tr>
                                        <tr>
                                           <td>". $mail ."</td><td>". $mdp ."</td>
                                        </tr>
                                   </table>
                                 </body>
                             </html>";

                $reponses = '';

                if (mail($destinataire, $sujet, $messages, $headers)) {
                    sleep(1);
                    unset($_POST);//vide le formulaire
                }
            }catch (Exception $e) {
                $reponse .= "echecc";
            }
            $reponse .= 'succes';

        }else{
            $reponse .= 'no_succes';
        }

    }
}







echo $twig->render('register.kmphtml.twig',[
    'message'=>$reponse,
    'message_succes'=>'Votre inscription a été enregistrée, merci de vérifier votre adresse email pour récupérer votre mot de passe.',
    'message_existe'=> 'Désolé ce votant existe déjà dans notre base de données',
    'message_echec'=>'Echec d\'enregistrement veuillez verifier si les informations sont correctes',
]);



function connect(){
    return isset($_SESSION['votant']);
}