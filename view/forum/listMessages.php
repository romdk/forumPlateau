<?php

$messages = $result["data"]['messages'];
    
?>

<div class="infoSujet">
    <p>Titre du sujet</p>
    <p>auteur du sujet</p>
    <p>date de creation du sujet</p>
</div>

<?php 
if(App\Session::getVisiteur()){ ?>
    <form class="nouveauMessage" action='index.php?ctrl=forum&action=ajoutMessage&id=<?=$id?>' method='post'>nouveau message
                <textarea class="champMessage" type="text" name="message" placeholder="Saisir un message"></textarea>
                <input class="btnAjouter" type="submit" name="ajouterMessage" value="Ajouter message">
    </form>
<?php } ?>

<div class="listeMessages">
    <?php
    foreach($messages as $message){
        ?>            
            <div class="message2">
                <p class="pseudo"><?=$message->getVisiteur()->getPseudonyme()?></p>
                <p class="role"><?=$message->getVisiteur()->getRole()?></p>
                <p class="date"><?=$message->getDateCreation()?></p>
                <p class="texte"><?=$message->getMessage()?></p>
                <div class="interactions">
                    <div class="vote">
                        <button><i class="fa-solid fa-up-long"></i></button>
                        <p><?=$message->getNbVote()?></p>
                        <button><i class="fa-solid fa-down-long"></i></button>
                    </div>
                    <?php
                    if(App\Session::getVisiteur()){
                        if(App\Session::isAdmin() || App\Session::getVisiteur()->getId() == $message->getVisiteur()->getId()){ ?>
                            <div class="supprimer">
                                <a class="btnSupprimer" href="index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId()?>">Supprimer<a>
                            </div>
                        <?php 
                        }
                    } ?>
                </div>
            </div>            
        <?php
    }
?>


