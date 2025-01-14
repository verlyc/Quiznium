## QUIZNIUM

<p>
Le projet consiste à développer une application web interactive permettant aux utilisateurs de participer à des quiz sur divers sujets. Ces quiz seront créés et gérés par des administrateurs qui auront accès à un tableau de bord pour modifier les questions et gérer les utilisateurs. Le projet vise à offrir une plateforme ludique et éducative où les utilisateurs peuvent tester et améliorer leurs connaissances tout en gagnant des scores.
</p>

## Prérequis Sans Docker

* PHP 8.2+
* MysQL
* Composer 2

## Configuration

1. **Copiez le fichier `.env.example`** en `.env` et configurez les valeurs nécessaires pour la base de données :

    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=quiznium
    DB_USERNAME=root
    DB_PASSWORD=
    ```


1. **Installer les dépendances Laravel :**

    ```bash
     composer install
     php artisan key:generate
     php artisan storage:link
    ```

2. **Migration de la base de données :**

   Pour migrer la base de données, utilisez :

    ```bash
     php artisan migrate
    ```

   Pour créer un utilisateur admin, utilisez :

    ```bash
     php artisan make:filament-user
    ```

## Utilisation
Pour lancer l'application, utilisez :

 ```bash
     php artisan serve
   ```


