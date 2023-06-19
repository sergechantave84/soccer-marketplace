# soccer-marketplace
Description: Marketplace pour les équipes de football

# Technologies utilisées
- MariaDB
- PHP 8
- Symfony 6
- AdminLTE
- JSTable

# Pré-requis
- MariaDB
- PHP 8.1 ou supérieur

# Installation
```
  git clone https://github.com/sergechantave84/soccer-marketplace.git
  php bin/console doctrine:database:create
  php bin/console d:s:u --force --complete
```

# Exécuter l'application
```
cd soccer-marketplace
php -S 127.0.0.1:8000 -t public
```

# Utilisation de l'application
Accéder à l'url : http://localhost:8000