# Système de Gestion de Bibliothèque

## Introduction

Ce projet est un système de gestion de bibliothèque développé en PHP. Il permet de gérer les livres, les membres et les emprunts de manière efficace.

## Fonctionnalités

- Gestion des livres (ajout, suppression, modification)
- Gestion des membres (ajout, suppression, modification)
- Gestion des emprunts (enregistrement, retour)
- Recherche avancée de livres
- Interface d'administration
- Authentification sécurisée

## Technologies utilisées

- PHP 7.4+
- MySQL
- HTML5/CSS3
- JavaScript

## Installation avec Docker

Le projet est conteneurisé avec Docker pour une installation facile.

### Prérequis

- Docker
- Docker Compose

### Étapes d'installation

1. Cloner le dépôt :

   ```bash
   git clone https://github.com/zenon12/systeme-de-gestion-de-bibliotheque.git
   cd systeme-de-gestion-de-bibliotheque
   ```

2. Démarrer les conteneurs :

   ```bash
   docker-compose up -d
   ```

3. Accéder à l'application :

   - Application : http://localhost:8000
   - PHPMyAdmin : http://localhost:8080

4. Importer la base de données :
   - Se connecter à PHPMyAdmin (root/root)
   - Créer une base de données nommée `library`
   - Importer le fichier `initdb/db.sql`

### Structure des conteneurs

- `php`: Serveur web avec PHP 7.4
- `mysql`: Base de données MySQL
- `phpmyadmin`: Interface d'administration MySQL

## Configuration manuelle

### Prérequis

- Serveur web (Apache/Nginx)
- PHP 7.4+
- MySQL 5.7+

### Étapes d'installation

1. Importer la base de données :

   ```bash
   mysql -u root -p library < database/gestion_biblioth__que.sql
   ```

2. Configurer les accès à la base de données dans `config/config.php`

3. Déployer les fichiers sur votre serveur web

## Utilisation

### Comptes par défaut

- Administrateur :

  - Email: mamadousaliouba588@gmail.com
  - Mot de passe: admin123

- Utilisateur :
  - Email: binta123@gmail.com
  - Mot de passe: user123

### Fonctionnalités principales

- **Gestion des livres** :

  - Ajout/suppression/modification
  - Recherche par titre, auteur ou genre

- **Gestion des utilisateurs** :

  - Inscription/connexion
  - Profil utilisateur

- **Gestion des emprunts** :
  - Emprunt/retour de livres
  - Historique des emprunts

## Développement

### Commandes utiles

- Redémarrer les conteneurs :

  ```bash
  docker-compose restart
  ```

- Voir les logs :

  ```bash
  docker-compose logs -f
  ```

- Arrêter les conteneurs :
  ```bash
  docker-compose down
  ```

### Structure du projet

```
.
├── config/          # Fichiers de configuration
├── database/        # Scripts de base de données
├── initdb/          # Données initiales
├── model/           # Modèles et couche d'accès aux données
├── src/             # Code source principal
├── views/           # Templates et vues
├── Dockerfile       # Configuration Docker pour PHP
└── docker-compose.yml # Configuration des services
```

## Contribution

Les contributions sont les bienvenues ! Veuillez suivre ces étapes :

1. Forker le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Committer vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Pousser vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.
