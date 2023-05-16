
# API Troc ta plante

API pour le projet Troc ta plante, projet CESI, CDA 2022.



## Tech Stack
- PHP 8
- Symfony 6
- ORM Doctrine
- MySQL 8


## Installation
Installer Symfony

https://symfony.com/doc/current/setup.html

Installer les dépendances du projet

```bash
  composer install
```
Créer un fichier .env.local et y ajouter
```
DATABASE_URL="mysql://username:password@127.0.0.1:3306/database_name?serverVersion=8.0&charset=utf8mb4"
```
Commenter la ligne `DATABASE_URL` dans le fichier .env

Création de la base de données, migrations de la de base de données
```bash
symfony console doctrine:database:create && symfony console doctrine:migrations:migrate
```

Création de la base de données, migrations de la base de données et ajout des données de test
```bash
symfony console doctrine:database:create && symfony console doctrine:migrations:migrate && symfony console doctrine:fixtures:load
```



## Lancer le projet

```bash
symfony serve
```
## Auteurs du projet

- [Mariam](https://github.com/Plumpqueen)
- [Lucile](https://github.com/Lucile-trp)
- [Grégory](https://github.com/gregory-lebl)

