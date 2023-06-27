# soccer-marketplace
Description: Marketplace pour les équipes de football

# Technologies utilisées
- MariaDB
- Composer 2.4
- PHP 8
- Symfony 6
- AdminLTE
- JSTable

# Pré-requis
- MariaDB
- Composer 2.4
- PHP 8.1 ou supérieur

# Installation
```
  git clone https://github.com/sergechantave84/soccer-marketplace.git
  composer update
  change variable DATABASE_URL
  php bin/console doctrine:database:create
  php bin/console d:s:u --force --complete
  php bin/console doctrine:database:create --env=test
```

# Création base de donnée réelle
```
  php bin/console doctrine:database:create
  php bin/console d:s:u --force --complete
```

# Création base de donnée de test
```
  php bin/console doctrine:database:create --env=test
  php bin/console d:s:u --force --complete --env=test
```

# Exécuter l'application
```
cd soccer-marketplace
php -S 127.0.0.1:8000 -t public
```

# Utilisation de l'application
Accéder à l'url : http://localhost:8000
## Menu Accueil
- Liste de toutes les équipes
NOTE: Vous ne pouvez ajouter des joueurs qu'à votre propre équipe graàce au bouton "Ajouter un joueur"

## Menu Créer une équipe
- C'est un menu pour accéder à la création d'une équipe et ajout de joueurs à cette équipe
NOTE:
* IL faut renseigner une adresse email pour accéder à ce menu (Veulliez cliquer sur le boton "Renseigner un émail")
* Un bouton "Se déconnecter" apparait une fois que vous avez renseigné une adresse email, afin de vous déconnecter 
de l'application et d'utiliser le site à l'aide d'un autre compte email.

## Menu Vendre/Acheter des joueurs
- C'est un menu pour accéder à la vente de vos propres joueurs d'une part et l'achat des joueurs des autres équipes d'autres parts
NOTE:
* Vous ne pouvez vendre que vos propres joueurs
* Vous ne pourrez acheter que les joueurs mis en vente par les autres équipes

# Tests unitaires
Lancer la commande 
```
php bin/phpunit
```