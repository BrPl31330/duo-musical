<?php

class Template
{
    // chaque page est une méthode de classe Template
    static function index()
    {
        Template::header();
        echo "<h1>Bienvenue sur ce site</h1>";

        Template::footer();
    }

    static function musiciens()
    {
        Template::header();
        echo "<h1>on est sur la page duo/trio</h1>";
        Template::footer();
    }

    static function fonctionnementSite()
    {
        Template::header();
        echo "<h1>on est sur la page fonctionnement site</h1>";
?>
        <section>
            <h2> Pourquoi ce site ?</h2>
            <p>J'ai pensé à ce site car ayant été beaucoup bougé en France et en Navare, j'ai voulu essayé de facilité les échanges entre musiciens, chanteurs. En effet, quand on arrive sur une nouvelle région, il n'est pas toujours facile de renouer contact avec d'autres musiciens</p>
            <p>Ce site fonctionnera en deux mouvements :</p>
            <ol>
                <li>Les utilisateurs de passage</li>
                <li>Les membres (ceux qui auront un compte)</li>
            </ol>
        </section>
        <section>
            <h2>Formulaire d'ouverture de compte</h2>
            <div>
                <label for="name">Nom :<abbr title="required">*</abbr></label>
                <input id="name" type="text" name="name">
                <div>
                    <br>
                    <label for="firstname">Prénom :<abbr title="required">*</abbr></label>
                    <input id="firstname" type="text" name="firstname">
                </div>
                <br>
                <label for="nickname">Pseudo :<abbr title="required">*</abbr></label>
                <input id="nickname" type="text" name="nickname">
                
                <div>
                <br>
                <label for="region">Quelle est votre région  :<abbr title="required">*</abbr></label>
                <input id="region" type="text" name="region">
                </div>
                <div>
                    <article>
                        <form method="post">
                            <p>Quel style de musique jouez-vous ?</p>
                            <select name="jouerMusique">
                                <option>Choisir</option>
                                <option>Variété </option>
                                <option>Classique </option>
                                <option>Jazz </option>
                            </select><br />
                    </article>
                    <article>
                        <p>Quel niveau musical avez-vous ?</p>
                        <select name="niveauMusique">
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
    <?php
        Template::footer();
    }

    static function contact()
    {
        Template::header();
        echo "<h1>on est sur la page contact</h1>";



        Template::footer();
    }

    static function error404()
    {
        Template::header();
        echo "<h1>désolé, page non trouvée</h1>";
        Template::footer();
    }

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
                    <a href="musiciens.php">On se fait un boeuf ?</a>
                    <a href="fonctionnementSite.php">Comment ça marche</a>
                    <a href="contact.php">contact</a>
                </nav>
            </header>
            <main>


            <?php
        }

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
