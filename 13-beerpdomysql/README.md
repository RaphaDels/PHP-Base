# Beer PDO SQL

A partir du tableau, on doit reproduire le schéma de la BDD sur WorkBench.

A partir du schéma, on pourra créer la base de données.

Au niveau du PHP, nous aurons besoin de créer plusieurs fichiers :
- config/database.php -> Connexion à la base de données en PDO, sera inclus dans tous les fichiers PHP
- partials/header.php -> Le header du site à inclure dans toutes les pages (Bootstrap)
- partials/footer.php -> Le footer du site à inclure dans toutes les pages
- index.php -> Page d'accueil du site
- beer_list.php -> Lister toutes les bières de la BDD
- beer_single.php -> La page d'une bière seule

## Ajout d'une bière

- Créer la page beer_add.php
- Ne pas oublier d'inclure le header et le footer
- Ajouter un titre "Ajouter une bière"
- Ajouter un formulaire avec les champs suivants :
    - Nom : Champ saisie libre
    - Degrès : Champ saisie libre ou range
    - Volume : Champ select
    - Prix : Champ saisie libre
    - Marque : Champ select ou autocompletion (datalist)
    - Type : Champ select ou autocompletion (datalist)
- Ne pas oublier le bouton pour soumettre le formulaire
- Ne pas oublier la méthode du formulaire
- Lorsque le formulaire est soumis, il faudra récupérer la valeur de chacun des champs

## Recherche d'une bière

- Ajouter un formulaire de recherche dans le header avec un champ texte "query" et un bouton "Rechercher"
- On peut saisir le nom d'une bière et quand on soumet le formulaire, on doit être redirigé vers
search.php?q=SAISIE
- Créer un fichier search.php (inclure le header et le footer)
- Vérifier que la clé "query" existe dans la superglobale $_GET
- Si la clé existe, on doit effectuer une requête SQL qui va chercher toutes les bières ayant le nom qui contient la valeur saisie.
- Afficher les résultats de la même manière que sur la page des bières, le titre sera "Résultat de votre recherche pour : SAISIE"

# CRUD Brasserie

- Créer une page "brewery_list.php" qui liste les brasseries présentes dans la base de données (Nom, adresse, ville, code postal et pays). Par exemple les Tables de Bootstrap.
- Créer une page "brewery_single.php" qui affiche les informations d'une brasserie seule
- Créer une page "brewery_add.php" qui affichera un formulaire permettant d'ajouter la brasserie dans la base de données.
    - name: Au minimum 3 caractères
    - address: Au minimum 10 caractères
    - city: Au minimum 3 caractères
    - zip: De 1 à 5 caractères
    - country: select avec quelques pays (France, Belgique, Royaume-Uni, Irelande, Allemagne, Italie)
- Si le formulaire comporte des erreurs, il faudra les afficher au dessus du formulaire
- Si le formulaire est valide, on ajoute la brasserie dans la BDD et on affiche un message de succès
