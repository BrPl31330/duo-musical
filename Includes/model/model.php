<?php
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
            define("DBNAME", "essai-duo-musical");

            $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;
            
            try{
                // On se connecte à la base de données en "instanciant" PDO
                Model::$db = new PDO($dsn, DBUSER, DBPASS);    // => PHP APPELLE LA METHODE CONSTRUCTEUR AVEC LES PARAMETRES
                // => ici on aura une valeur dans Model::$db != null

                // On définit le charset à "utf8"
                Model::$db->exec("SET NAMES utf8");
            
                // On définit la méthode de récupération (fetch) des données
                Model::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            }
            catch (PDOException $e) {
                // PDOEException $e -> on attrape l'erreur provoquée par le new PDO en cas d'échec
                // On affiche le
                die($e->getMessage());
            }
        }
        
    }
//**********************inserer article blog****************** */
    // methode pour inserer une ligne dans la table SQL articles
    static function insererArticle ($tableauAsso)
    {
        // SQL
        Model::connexion();
        // On écrit la requête
        $sql = 
        <<<sql
        INSERT INTO `article`
        (`titre`, `slug`, `contenu`, `image`, `categorie`, `priorite`, `creer_le`) 
        VALUES 
        (:titre, :slug, :contenu, :image, :categorie, :priorite, :creer_le)
        sql;

        // On prépare la requête
        $query = Model::$db->prepare($sql);

        // On injecte les paramètres
        // $query->bindValue(":titre", $titre, PDO::PARAM_STR);
        // $query->bindValue(":contenu", $contenu, PDO::PARAM_STR);

        // On exécute (TODO: AJOUTER SECURITE...)
        $query->execute($tableauAsso);

        // On récupère l'id du dernier insert dans la base
        $idArticle = Model::$db->lastInsertId();
        
    }

    //********************inserer User**************** */

    static function insererUser($tableauAsso)
    {
        Model::connexion();
        $sql =
        <<<sql
        INSERT INTO `user` 
        (`nom`,`password`, `date_entree`, `rgpd`)
        VALUES 
        (:nom, :password, :date_entree, 1 )
        sql;

        //requête
        $query = Model::$db->prepare($sql);
        //Execution requête
        $query->execute($tableauAsso);

        $idUser = Model::$db->lastInsertId();
       
    }
    //*************lire article************************************ */
   // READ liste
   static function lireArticles ($categorie = "musique")
   {
       Model::connexion();

       // requete SQL
       // Ici on affichera les articles
       // On récupère les données dans la base
       // On écrit la requête
       $sql        = 
       <<<x
       SELECT * FROM `article` 
       WHERE categorie = '$categorie'
       ORDER BY priorite ASC
       x;
       $query      = Model::$db->query($sql);

       return $query;      // la méthode ne transmet pas la variable sinon
   }

       // READ 1 ligne
       static function lireArticle ($colonne, $valeurCherchee)
       {        
           Model::connexion();
   
           // requete SQL
           // Ici on affichera les articles
           // On récupère les données dans la base
           // On écrit la requête
           $sql    = "SELECT * FROM article WHERE $colonne = :$colonne";
           $query  = Model::$db->prepare($sql);
           // $query->bindValue($colonne, $valeurCherchee);
           $query->execute([ $colonne => $valeurCherchee ]);
   
           return $query;      // la méthode ne transmet pas la variable sinon
       }

    





}
