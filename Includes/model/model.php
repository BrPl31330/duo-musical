<?php

// EMBAUCHER UN DEV QUI CONNAIT SQL, MAIS PAS DE CONNAITRE HTML
class Model
implements Contrat
{
    // PROPRIETE
    static $db = null;

    // METHODES DE CLASSE (static)
    static function connexion()
    {
        // on améliore le code pour ne faire la connexion qu'une seule fois
        if (Model::$db == null) {
            // connexion
            define("DBHOST", "localhost");
            define("DBUSER", "root");
            define("DBPASS", "");
            define("DBNAME", "duo_musical");

            $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

            try {
                // On se connecte à la base de données en "instanciant" PDO
                Model::$db = new PDO($dsn, DBUSER, DBPASS);    // => PHP APPELLE LA METHODE CONSTRUCTEUR AVEC LES PARAMETRES

                // On définit le charset à "utf8"
                Model::$db->exec("SET NAMES utf8");

                // On définit la méthode de récupération (fetch) des données
                Model::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // PDOEException $e -> on attrape l'erreur provoquée par le new PDO en cas d'échec
                // On affiche le
                die($e->getMessage());
            }
        }
    }

    static function insererFormulaire($tableauAsso)
    {
        //SQL
        model::connexion();
        //Ecriture requête
        $sql =
            <<<x
        INSERT INTO `formulaire`
        (`name`, `first-name`, `nickname`, `region`, `musique`, `level`, `created_at`)
        VALUES
        (:name, :firstname, :nickname, :region, :musique, :level, :created_at)
        sql;
        x;
        //Préparation requête
        $query = Model::$db->prepare($sql);

        $query->execute($tableauAsso);

        $idformulaire = Model::$db->lastInsertId();
    }
}
