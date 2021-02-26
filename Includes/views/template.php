<?php

class Template
{
    //**********page index********** */
    static function index()
    {
        Template::header();
        echo "<h1>Bienvenue sur ce site</h1>";
?>
        <section>
            <h2> Pourquoi ce site ?</h2>
            <p>J'ai pensé à ce site car ayant été beaucoup bougé en France et en Navare, j'ai voulu essayé de facilité les échanges entre musiciens, chanteurs. En effet, quand on arrive sur une nouvelle région, il n'est pas toujours facile de renouer contact avec d'autres musiciens</p>
            <p>Ce site fonctionnera en deux mouvements :</p>
            <ol>
                <li>Les utilisateurs de passage qui ne pourront que voir les annonces.</li>
                <li>Les membres (ceux qui auront un compte), qui pourront passer des annonces.</li>
            </ol>
            <p>Pour cela, tu as juste à te connecter ci-dessous.</p>
        </section>
        <?php
        echo
        <<<x
            <section>
                <form method="post">
                    <label>
                        <div>nom</div>
                        <input name="nom" type="text" required placeholder="entrez votre nom" >
                    </label>
                    <label>
                        <div>Mot de passe</div>
                        <input name="password" type="pass" required placeholder="entrez votre mot de passe"  >
                    </label>
                    <br>
                    <div>
                        <input name="rgpd" type="checkbox" id="rgpd" required placeholder="validez rgpd">
                        <label for="rgpd">J'accepte la collecte de mes données personnelles dans le cadre exclusif de ce formulaire de contact. J'ai bien noté que ces données ne seront pas cédées à des entreprises tierces et seront détruites à l'issue de cette transaction commerciale ou au plus tard au bout de 13 mois.</label>
                    </div>
                    <div>
                        <button type="submit">valider</button>
                    </div>
                </form>
            </section>
            x;
        Controller::traiterPassword();


        echo "<section>";
        echo "<h2>groupe recherche musiciens</h1>";
        // on va ajouter une section qui affiche les articles dans la catégorie compétences
        // ICI ON VA AFFICHER LES ARTICLES
        // en poo, on utilise une méthode au lieu de faire require_once
        // on va afficher seulement les articles de la catégorie "galerie"
        $query = Model::lireArticles("groupe");

        // On récupère les données
        $articles = $query->fetchAll(); // Après un fetchAll on a TOUJOURS un foreach
        foreach ($articles as $article) :
            // astuce
            extract($article);  // => crée des variables à partir des clés/colonnes
            // $id, $title, $slug, etc...            
            echo
            <<<x
                    <article>
                        <h3>$titre</h3>
                        <p>$contenu</p>
                    </article>
                x;
        endforeach;
        echo "</section>";

        echo "<section>";
        echo "<h2>musiciens recherche groupe</h2>";
        // on va ajouter une section qui affiche les articles dans la catégorie compétences
        // ICI ON VA AFFICHER LES ARTICLES
        // en poo, on utilise une méthode au lieu de faire require_once
        // on va afficher seulement les articles de la catégorie "galerie"
        $query = Model::lireArticles("musicien");

        // On récupère les données
        $articles = $query->fetchAll(); // Après un fetchAll on a TOUJOURS un foreach
        foreach ($articles as $article) :
            // astuce
            extract($article);  // => crée des variables à partir des clés/colonnes
            // $id, $title, $slug, etc...            
            echo
            <<<x
                    <article>
                        <img src="uploads/images/$image" alt="$titre"> 
                        <h3>$titre</h3>
                        <p>$contenu</p>
                    </article>
                x;
        endforeach;
        echo "</section>";

        Template::footer();
    }

    //******************Page contact************ */
    static function Blog()
    {

        Template::header();
        echo "<h1>on est sur la page blog</h1>";
        // ICI ON VA AFFICHER LES ARTICLES
        // en poo, on utilise une méthode au lieu de faire require_once
        // on va afficher seulement les articles de la catégorie "news"
        $query = Model::lireArticles();

        // On récupère les données
        $articles = $query->fetchAll(); // Après un fetchAll on a TOUJOURS un foreach
        foreach ($articles as $article) :
            // astuce
            extract($article);  // => crée des variables à partir des clés/colonnes
            // $id, $title, $slug, etc...
            $dateAffichee = date("d/m/Y à H:i:s", strtotime($creer_le));

            echo
            <<<x
                    <article>
                        <h3><a href="./$slug.php">$titre</a></h3>
                        <p>Article écrit le $dateAffichee dans $categorie</p>
                        <div>$contenu</div>
                    </article>
                x;
        endforeach;
        Template::footer();
    }

    //******************Page membre************ */
    static function membre()
    {
        Template::header();
        echo
        <<<x
        <section>
            <h1>Espace membre</h1>
            <h2>Je complète mon profil</h2>
            <div>
                <div>
                    <label for="nom">Nom :<abbr title="required">*</abbr></label>
                    <input id="nom" type="text" name="nom">
                </div>
                <br>
                <div>
                    <label for="pseudo">Pseudo :<abbr title="required">*</abbr></label>
                    <input id="pseudo" type="text" name="pseudo">
                </div>
                <br>
                <div>

                    <label for="region">Quelle est votre région  :<abbr title="required">*</abbr></label>
                    <input id="region" type="text" name="region">
                </div>
                <div>

                <div>

                    <article>
                        <form method="post">
                            <p>Quel style de musique jouez-vous ?</p>
                            <select name="musique">
                                <option>Choisir</option>
                                <option>Variété </option>
                                <option>Classique </option>
                                <option>Jazz </option>
                            </select><br />
                    </article>
                    <article>
                        <p>Quel niveau musical avez-vous ?</p>
                        <select name="niveau">
                            <option>Choisir</option>
                            <option>Débutant </option>
                            <option>Connaissances Moyennes </option>
                            <option>Bonnes Connaissances </option>
                        </select>
                    </article>
                </div>
                <br>
                <div>
                    <button type="submit">Valider ses choix</button>
                </div>

                </form>
            </div>
        </section>
    x;
        Template::footer();
    }
    //****************Page Admin**************** */
    static function admin()
    {
        Template::header();
        echo "<h1>on est sur la page admin</h1>";
        echo
        <<<x
            <section>
                <h3>formulaire de création d'article</h3>
                <form method="POST" enctype="multipart/form-data">
                    <label>
                        <div>titre</div>
                        <input name="titre" type="text" required placeholder="entrez le titre">
                    </label>
                    <label>
                        <div>slug</div>
                        <input name="slug" type="text" required placeholder="entrez le slug">
                    </label>
                    <label>
                        <div>picture</div>
                        <input name="image" type="file" required placeholder="entrez le chemin pour picture">
                    </label>
                    <label>
                        <div>categorie</div>
                        <input name="categorie" type="text" required placeholder="entrez la catégorie">
                    </label>
                    <label>
                        <div>priorité</div>
                        <input name="priorite" type="text" required placeholder="entrez la priorité">
                    </label>
                    <label>
                        <div>contenu</div>
                        <textarea name="contenu" rows="6" cols="80" required placeholder="entrez le contenu"></textarea>
                    </label>
                    <div>
                        <button type="submit">PUBLIER L'ARTICLE</button>
                    </div>
                </form>   
            </section>
        x;

        // séparation MVC: on sépare le code de traitement dans une partie controller
        Controller::traiterFormulaire();

        Template::footer();
    }
    //******************Page contact************ */
    static function contact()
    {
        Template::header();
        echo "<h1>on est sur la page contact</h1>";

        Template::footer();
    }

    //**************Page error 404******************** */
    static function error404()
    {
        Template::header();
        echo "<h1>désolé, page non trouvée</h1>";
        Template::footer();
    }

    //************section header**************** */
    static function header()
    {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Appli Musiciens</title>

            <link rel="stylesheet" href="CSS/style.css">
        </head>

        <body>
            <header>
                <nav>
                    <a href="index.php">accueil</a>
                    <a href="blog.php">On se fait un boeuf ?</a>
                    <a href="membre.php">Page membre</a>
                    <a href="contact.php">contact</a>
                </nav>
            </header>
            <main>


            <?php
        }

        //***************Section footer******* */
        static function footer()
        {
            ?>
            </main>
            <footer>
                <br>
                <nav>
                    <a href="credits.php">crédits</a>
                    <a href="mentions-legales.php">mentions légales</a>
                </nav>
                <nav>
                    <a href="admin.php">admin</a>
                </nav>
                <p>tous droits réservés</p>
            </footer>
        </body>

        </html>
<?php
        }
    }
