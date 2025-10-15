# Pierre API Uber

## Description
Pierre API Uber est une API conçue pour gérer les fonctionnalités principales d'une application de type Uber.

## Fonctionnalités
- Gestion des chauffeurs
- Gestion des clients
- Gestion des trajets
- Gestion des voitures

## Prérequis
- PHP >= 7.4
- Serveur web (Apache, Nginx, etc.)
- MySQL

## Installation
1. Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/pierre-api-uber.git
    ```
2. Accédez au dossier du projet :
    ```bash
    cd pierre-api-uber
    ```

## Utilisation
- Accédez à l'API via `http://localhost:8000`
- Consultez la documentation de l'API pour les points de terminaison disponibles.

## Endpoints de l'API

Voici les différents endpoints de l'API : 
- `GET /chauffeurs` → Afficher la liste des chauffeurs
- `GET /chauffeurs/{id}` → Afficher le chauffeur avec l'id égal à {id}
- `GET /chauffeurs/{id}/voiture` → Afficher toutes les voitures du chauffeur {id}
- `GET /clients` → Afficher la liste des clients
- `GET /clients/{id}` → Afficher le client avec l'id égal à {id}
- `GET /trajets` → Afficher la liste des trajets
- `GET /trajets/{id}` → Afficher le trajet avec l'id égal à {id}
- `GET /trajets/{id}/details` → Afficher le détail des trajets de l'id égal à {id}
- `GET /voitures` → Afficher la liste des voitures
- `GET /voitures/{id}` → Afficher la voiture avec l'id égal à {id}

- `POST /chauffeurs` → Créer un nouveau chauffeur
- `POST /clients` → Créer un nouveau client

- `PUT /chauffeurs/{id}` → Modifier un chauffeur avec son id
- `PUT /clients/{id}` → Modifier un client avec son id

