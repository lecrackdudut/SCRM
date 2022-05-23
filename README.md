# SCRM

SCRM - l'outil ultime de la gestion de projets SCRUM.

## Installation

SCRM est installable sur sa propre machine à l'aide de docker et contient tous les éléments nécessaires à son execution (dépendances, serveur mail de débug, suite de tests, etc).

### Pré-requis

- docker et docker-composer installés (Windows supporté à l'aide de docker installé dans WSL2).
- Optionnel : définir un alias bash : `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`

### Installation 

- `git clone` le projet 
  - sur Windows, cloner le projet dans la partition Linux (WSL2)
- `cd` dans le projet
- `cp .env.example .env`
- installer les dépendances (depuis le dossier du projet) :

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

> Cette commande nous a installé Laravel Sail, un outil qui permet de faire le lien entre docker et notre appli Laravel.

- installer le reste des dépendances :
> utiliser la commande `vendor/bin/sail` à la place de `sail` si l'alias optionnel n'est pas défini

```bash
sail up -d
sail artisan key:generate
sail artisan migrate
sail npm install
sail npm run dev
```

### Utilisation

`sail up -d` lance l'application. Elle est disponible à l'adresse http://localhost

`sail npm run hot` pour lancer la compilation du js automatiquement

Le développement se fait dans le dossier courant. Pas besoin de rebuild ses conteneurs pour voir ses modifications.

Commandes disponibles :
- `sail php` pour lancer des commandes php
- `sail artisan` pour lancer des commandes Laravel
- `sail npm` pour lancer des commandes npm
- `sail` pour voir la liste des commandes sail disponibles
