<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# Site web de réservation de chambres en ligne

Permet de réserver des chambres et d’administrer vos chambres grâce à cette application.

Voici à quoi ressemble le site :
![Capture d’écran 2024-06-09 à 15 34 45](https://github.com/mathA1005/fredhd/assets/125377274/5c0cdc73-e4cd-44a0-9b72-b1b9baa245c6)



Il est développé en Laravel, Tailwind et js Easepick. Il intègre un calendrier Easepick.

## Prérequis

- Avoir Git installé sur votre machine
- Avoir Composer installé pour la gestion des dépendances PHP
- PHP >= 8.2
- Une base de données MySQL.

# Installation et Configuration du Projet

1. **Cloner le Projet GitHub**

   Ouvrez un terminal et clonez le dépôt en utilisant le lien HTTPS que vous avez. Remplacez par le lien réel du projet GitHub :

2. **Naviguer dans le Répertoire du Projet**

Changez de répertoire pour entrer dans le dossier du projet cloné:
`cd Fredhd`

3. **Installer les Dépendances PHP**

Exécutez Composer pour installer les dépendances PHP du projet :
`composer install`

4. **Installer les Dépendances npm**

Installez les dépendances npm pour gérer les packages JavaScript :
`npm install`

5. **Configurer le Fichier .env**

Copiez le fichier `.env.example` en `.env` si cela n'a pas déjà été fait :
Ouvrez le fichier `.env` avec votre éditeur de texte et modifiez les valeurs de `APP_NAME` avec le nom de votre application et `DB_DATABASE` avec le nom de votre base de données.

6. **Exécuter les Migrations de Base de Données**

Pour créer les tables dans votre base de données, exécutez :
`php artisan migrate`

7. **Réinitialiser la Base de Données avec des Données de Test (Optionnel)**

Si vous souhaitez réinitialiser votre base de données et la remplir avec des données de test, utilisez :
`php artisan migrate:fresh --seed`

8. **Générer une Clé d'Application**

Générez une nouvelle clé d'application Laravel :
`php artisan key:generate`

9. **Compiler les Assets**

Compilez les assets (CSS, JavaScript) pour le développement :
`npm run dev`
