<?php

class Controller
{
    static $tabErreur = [];
    // memorise les erreurs du formulaire

    static function traiterFormulaire()
    {
        if (!empty($_POST)) {
            //reçu infos formulaire
            //TODO AJOUTER FILTRES SECURITE
            $tableauAsso = [
                "name"       => Controller::filtrerTexte("name"),
                "firstname"  => Controller::filtrerTexte("firstname"),
                "nickname"   => Controller::filtrerTexte("nickname"),
                "region"     => Controller::filtrerTexte("region"),
                "musique"    => Controller::filtrerTexte("musique"),
                "level"      => Controller::filtrerTexte("level"),
                "created_at" => date("Y-m-d H:i:s"),
            ];

            //tableau erreurs vides ?
            if (empty(Controller::$tabErreur)) {
                //Insertion dans data-base
                Model::insererFormulaire($tableauAsso);

                // DEBUG
                echo "<strong>votre article est publié</strong>";
                //Debug

                // Model::insererDanger($tableauAsso);   
            } else {
                echo "<strong> il y a des erreurs : </strong>";
                foreach (Controller::$tabErreur as $erreur) {
                    echo
                    <<<x
                    <div class="erreur">$erreur</div>
                    x;
                }
            }
        }
    }

    static function filtrerTexte ($cle)
    {
        $înfoExterieur = $_POST["$cle"] ?? "";  // ?? => isset
        //filtrage des infos
        $înfoExterieur = strip_tags($înfoExterieur);
        $infoExterieur = trim($înfoExterieur);

        //Info vide ?
        if ($infoExterieur == "") {
            //Ajout erreur
            Controller::$tabErreur[] = "erreur sur $cle";
        }
        return $infoExterieur;
    }
    
}
