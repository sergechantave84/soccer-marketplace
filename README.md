# soccer-marketplace
Description: Marketplace pour les équipes de football

# Technologies utilisées
- docker-compose 1.28.6
- MariaDB 10.4
- Composer 2.4.2
- PHP 8.2
- Symfony 6
- AdminLTE
- JSTable

# Installation
```
  git clone https://github.com/sergechantave84/soccer-marketplace.git
```
```
  cd soccer-marketplace
```
```
  docker/php-fpm/docker-compose-1.28.6 -f docker-compose.yml -f local.yml up -d
```

# Création base de donnée de test dans le container soccer_marketplace_local_php
```
  docker exec -it soccer_marketplace_local_php /bin/sh
```
```
  php bin/console doctrine:database:create --env=test
```
```
  php bin/console d:s:u --force --complete --env=test
```
```
  exit
```
## Tests unitaires
Entrer dans container soccer_marketplace_local_php si vous n'y êtes pas encore
```
docker exec -it soccer_marketplace_local_php /bin/sh
```
Dans le container soccer_marketplace_local_php, lancer la commande suivante :
```
php bin/phpunit
```

# Utilisation de l'application
Accéder à l'url : https://localhost:8303/
**REM**:  Le navigateur bloque l'accès au site car le certificat SSL est un faux, 
il faut alors pour firefox cliquer sur **avancé** , puis sur **Accepter le risque et poursuivre** , pour Chrome cliquer sur **faire une exception**, puis **aller vers le site**

Une fois la page d'accueil ouverte, renseigner l'adresse email: schantave@bocasay.com en cliquant sur le bouton "Renseigner une adresse email"

## Menu Accueil
- Liste de toutes les équipes
- NOTE: 
  - Vous ne pouvez ajouter des joueurs qu'à votre propre équipe gràce au bouton "Ajouter un joueur"

## Menu Créer une équipe
- C'est un menu pour accéder à la création d'une équipe et ajout de joueurs à cette équipe
- NOTE :
  - Il faut renseigner une adresse email pour accéder à ce menu (Veulliez cliquer sur le boton "Renseigner un émail")
  - Un bouton "Se déconnecter" apparait une fois que vous avez renseigné une adresse email, afin de vous déconnecter 
de l'application et d'utiliser le site à l'aide d'un autre compte email.

## Menu Vendre/Acheter des joueurs
- C'est un menu pour accéder à la vente de vos propres joueurs d'une part et l'achat des joueurs des autres équipes d'autres parts
- NOTE :
  - Vous ne pouvez vendre que vos propres joueurs
  - Vous ne pourrez acheter que les joueurs mis en vente par les autres équipes

