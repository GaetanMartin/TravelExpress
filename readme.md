# Projet Travel Express

### 8INF843 - Systèmes répartis : Devoir n°2

Réalisation d'une plateforme web semblable à Amigo Express

+ Laravel 5.5.18
+ PHP 7  

Le site est actuellement accessible à l'adresse : http://51.255.41.18/travelexpress/public/index.php/fr/home

### Installation

+ Créer une nouvelle base de données sous le nom de travelexpress

+ Récupérer le code source avec : 
```
git clone https://github.com/GaetanMartin/TravelExpress .
```

+ Installer les dépendances
```
composer install
```

+ Configurer son environnement depuis le fichier .env
```
cp .env.example .env
vi .env
```

+ Créer les tables et peupler automatiquement avec :
```
php artisan migrate:refresh --seed
```

+ Changer les autorisations avec : 
```
chmod -R o+w storage
chmod 700 .env
```

Le site est opérationnel est accessible @ host/travelexpress/public/index.php/fr/home
