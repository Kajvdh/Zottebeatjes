<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();

$login = new Login();
$member = new Member($db);
if ($login->getSession()) {
    $member->getById($login->getSession());
    $smarty->assign('login',$member->getUsername());
}


$smarty->display('header.tpl');
echo PHP_EOL;



if (!$member->getUsername()) {
    //gebruiker niet ingelogd
    $smarty->display('not_logged_in.tpl');
}
else {
    $avatar_errors = array();
    if ((isset($_POST['Submit'])) && ($_POST['Submit'] == 'Upload')) {    
        //Avatar geupload
        include_once('lib/phpthumb/ThumbLib.inc.php');


        if (!getimagesize($_FILES['avatar']['tmp_name'])) {
            //Geen geldige afbeelding
            array_push($avatar_errors,"Ongeldig bestandsformaat");
        }
        else {
            //Geldige afbeelding

            $imgtype = array(
                '1' => '.gif', 
                '2' => '.jpg' , 
                '3' => '.png');

            //Breedte, hoogte, extensie ophalen
            list($width, $height, $type) = getimagesize($_FILES['avatar']['tmp_name']);

            //Extensie aan variabele toewijzen
            switch ($type) {
                case 1: $ext='.gif'; break;
                case 2: $ext = '.jpg';break;
                case 3: $ext='.png'; break;
            }

            //Afmetingen afbeelding controleren
            if ($width > 1000 || $height > 1000) {
                //Te grote afmetingen
                array_push($avatar_errors,"De afbeelding mag maximum 1000x1000 pixels groot zijn");
            }
            else {
                //Afbeelding niet te groot

                //Maximum grootte
                if ($_FILES['avatar']['size'] > 500000 ) {
                    //Afbeelding te groot
                    array_push($avatar_errors,"De afbeelding mag niet groter dan 500kB zijn");
                }
                else {
                    //Afbeelding niet te groot

                    $uploaddir = 'uploads/';
                    $secondname = rand(1,999);
                    $uploadfile = $uploaddir . "img-" .$login->getSession() . "-" . $secondname . $ext;

                    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile )) {
                        array_push($avatar_errors,"De afbeelding kon niet geupload worden");
                    }
                    else {
                        $thumb = PhpThumbFactory::create($uploadfile);
                        $thumb->resize(100,100);
                        $thumb->save($uploadfile);

                        $member->setAvatar($uploadfile);
                        if (!$member->updateAvatar()) {
                            //Updaten in de database mislukt
                            array_push($avatar_errors,"De nieuwe afbeelding kon niet opgeslagen worden");
                        }
                        else {
                            //Updaten avatar gelukt
                        }
                    }
                }
            }
        }
    }
    $smarty->assign('avatar_errors',$avatar_errors);
    if (@is_array(getimagesize($member->getAvatar()))) {
        $smarty->assign('avatar',$member->getAvatar());
    }


    if ((isset($_POST['Submit'])) && ($_POST['Submit'] == 'Signature veranderen')) {  
        $member->setSignature($_POST['signature']);
        $member->updateSignature();    
    }

    if ($member->getSignature() != "") {
        $smarty->assign('signature',$member->getSignature());
    }

    $smarty->display('usercp.tpl');
}

echo PHP_EOL;
$smarty->display('footer.tpl');
?>