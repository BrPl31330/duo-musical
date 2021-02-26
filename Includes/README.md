## recap création projet avec Symfony


### INSTALLATION DE SYMFONY

    * si on travaille en équipe
    * une personne dans l'équipe qui fait l'installation le dossier symfony

            composer create-project symfony/website-skeleton symfony

    * cette personne complète l'installation

        pour garder un historique, on ajoute git (et ensuite faire des commits...)
        
            git init

        comme on utilise apache, il nous faut public/.htaccess

            composer require symfony/apache-pack

        pour préparer la database
        AJOUTER LA LIGNE DE CONFIG DANS LE FICHIER .env (à adapter à votre projet...)

        DATABASE_URL="mysql://root:@localhost:3306/symfony?serverVersion=5.7"

        dans le terminal, pour créer la database (vide...)
        php bin/console doctrine:database:create

        * github.com
            créer un repository (vide) sur github.com
            inviter les autres membres de l'équipe 
            (et les autres membres doivent accepter...)

            connecter votre dossier avec un repository github.com

            exemple:
                git remote add origin https://github.com/form2021/symfony.git (à personnaliser...)
                git branch -M main
                git push -u origin main

            => ENSUITE LES AUTRES MEMBRES DE L'EQUIPE PEUVENT FAIRE UN CLONE

                LES AUTRES SUR LEUR ORDINATEUR

                git clone https://github.com/form2021/symfony.git (à personnaliser...)

                ET IL FAUT COMPLETER L'INSTALLATION AVEC

                composer install

                php bin/console doctrine:database:create

        ICI, DANS CES ETAPES, CHACUN A UNE INSTALLATION D'UN SYMFONY SUR SON ORDINATEUR
        ET SON DOSSIER EST CONNECTE AU REPOSITORY GITHUB.COM POUR SYNCHRONISER LE CODE.
        => VOUS POUVEZ COMMENCER A TRAVAILLER EN EQUIPE

### PAGES PUBLIQUES

        * débuter avec quelques pages (facile...)
        * créer les pages sur la partie publique

        php bin/console make:controller SiteController (à personnaliser...)

### LES ENTITES ET LE CRUD

#### LES User ET LA SECURITE

        ET APRES INSTALLER TOUTE LA PARTIE User ET SECURITE

        php bin/console make:user
        ...
        php bin/console make:auth
        ...
        php bin/console make:registration-form


        php bin/console make:migration
        php bin/console doctrine:migrations:migrate

        protéger la partie admin, dans le fichier config/packages/security.yaml

        # Easy way to control access for large sections of your site
        # Note: Only the *first* access control that matches will be used
        access_control:
            - { path: ^/admin, roles: ROLE_ADMIN }
            - { path: ^/membre, roles: ROLE_USER }

#### LES ENTITES POUR VOTRE PROJET

        Et ensuite créer les entités...
        php bin/console make:entity

        php bin/console make:migration
        php bin/console doctrine:migrations:migrate

        php bin/console make:crud

        => ajouter le préfixe /admin/ sur les routes (dans le fichier ...Controller.php)
        => active la protection des pages CRUD...

### AJOUTER LES PAGES SUPPLEMENTAIRES ET COMPLETER LE CODE SUR CHAQUE PAGE


    S'INSPIRER DU CODE GENERE PAR LE make:crud
    POUR CREER VOTRE CODE POUR LES AUTRES PAGES DE VOTRE PROJET...



## DEMARRER UN PROJET

    PERSONA
    * VISITEURS
        CHAQUE PERSONA A UNE PROBLEMATIQUE
        ET VOTRE PROJET LUI APPORTE UNE SOLUTION

        exemple: 
        je m'appelle Eric et j'habite à Lyons, je viens d'emménager dans cette ville suite à une mutation
        et je suis à la recherche de passionnés de musique pour jouer deux ou trois soirs par semaine
        sur internet et différents moyens de petites afiche, je vais trouver un site qui va m'aider à 
        résoudre ce problème
        (=> ce site c'est votre projet...)

        => à partir de ce persona, on peut créer un scénario d'utilisation (Use Case...)


        Exemple:
        Problème:
            Eric recherche des partenaires musiciens
        Solution apportée par le site:
            Eric peut publier une annonce sur le site
        Comment ça se passe:
            Eric arrive sur la page d'accueil et ne voit que quelques annonces, mais il veut en savoir plus et va s'enregistrer pour profiter de toutes les fonctionnalités de l'application...
            Eric se connecte à la base en renseignant son nom et son mot de passe.
            Eric clique sur le bouton pour aller sur la page de création de compte
            Eric remplit le formulaire de création ce compte
            Eric peut se connecter avec la page de login
            Eric arrive sur la page d'espace membre
            Eric peut créer une annonce
            Eric peut voir son annonce sur la page des annonces

        => donne les pages à créer et les actions à gérer sur chaque page pour réaliser le scénario
        => permet de tester si tout marche correctement

    PERSONA CLIENT
    * IMAGINER LE PROFIL DU CLIENT POUR LEQUEL VOUS DEVELOPPEZ LE PROJET
    => DONNE LE TYPE DE PARTIE ADMIN A CREER POUR CE CLIENT

    Bruno particulier ayant beaucoup déménagé dans sa carrière et toujours à la recherche de nouveaux
    collégues musiciens après chaque arrivée dans des nouvelles régions.
    Etant toujours mieux servi par soi-même et étant développeur web, il a décidé de prendre les choses
    en main.
    Il a décider de créer son propre site pour permettre à d'autres personnes d'en profiter,
    aux groupes de rechercher des musiciens et inversement.
    Le site fonctionne en deux mouvements :
    1 - Les utilisateurs de passage,
    2 - Les membres qui se sont enregistrés et qui font vivre le site.


## Appli aui regroupe les musiciens et les chanteurs
    Début 08/02/2021
    Je me sers des cours de PHP orienté objet pour commencer cette application. Ci-dessous se tiendra le réroulé des actions au jour le jour. 
    20/02/21 : bdd créer, formulaire créer (ne fonctionne pas)
    21/02/21 : Persona utilisateur et client fait.
               Amélioration du script "application",
               Affichage des annonce "exemple" sur page accueil (visible sans connexion),
