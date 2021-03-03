# BLOG ART 2021 C'est quoi ?

Blog'Art c'est un **projet étudiant** qui consiste à **créer un blog** afin de **mettre en pratique le PHP** fraichement étudié. Le thème fixé est **Bordeaux à travers...**
Dans le cas de notre groupe, nous avons décidé de porter le blog autour de **l'écologie à Bordeaux** et de rédiger 3 articles ayant pour thématique :
- L'évenement : L'évolution des évenements écologiques et leur impacte.
- L'acteur clé : Philippe Barre, Fondateur de Darwin
- L'insolite / le clin d'oeil : Article autour de Makyma, une initiative étudiante.

## Comment lancer le projet

### Installation de la base de donnée :

Télécharger les fichiers de la base de donnée juste ici : https://drive.google.com/drive/folders/1VULdfyibNIiz2eB2PKoXGa4FSb4kA0w2?usp=sharing
Créer une **base de donnée vierge** et y lancer tous les **scripts SQL**, selon l'éditeur nécessité de rajouter **"USE NOM_BASE_DE_DONNÉE"**


### Virtual host ou host classique ?

Afin d'obtenir la **meilleure expérience** possible, il est préconisé de configurer un **Virtual Host** afin de pouvoir profiter de la **réécriture d'URL** que propose le .htaccess
En revanche si cela n'est pas possible, il est tout de même possible de lancer le projet. Pour se faire passer dans le **.htaccess** le **RewriteEngine** à off :
```xml
...
25 RewriteEngine off 
...
```
Ensuite il faut de modifier les **liens d'accès au CSS et de redirection**. Pour cela il suffit simplement de décommenter certaines lignes et de commenter celle(s) du dessus. 
Voici la liste des fichiers où il y a des modifications à faire.
```
index.php
back/common/header.php
back/common/footer.php
front/includes/commons/header.php
front/includes/commons/footer.php
front/includes/pages/article.php
front/includes/pages/contact.php
front/includes/pages/home.php
front/includes/pages/login.php
front/includes/pages/logout.php
front/includes/pages/plan.php
front/includes/pages/register.php
```

### Ajout des variables de configuration

Il est nécessaire d'ajouter à la racine du projet un fichier **config.json** (disponible dans le drive) et d'y inclure le template suivant :
```json
{
    "CAPTCHA_SITE_KEY": "",
    "CAPTCHA_SECRET_KEY": "",
    "DB_HOSTNAME": "",
    "DB_NAME": "",
    "DB_USER": "",
    "DB_PASSWORD": ""
}
```
Il est également possible de configurer des **variables d'environnement** du même nom, plus une nommée "BLOGART_ENV" avec une valeur à **true**, afin de remplacer ce fichier **config.json**


## Groupe 4 - L'écoPin
- Maxence BREUILLES
- Elise ECHASSERIAU
- Anaïs MANCHOT
- Sébastien BONNEMAISON
- Adel SAANA
- Gaëtan JESTIN
