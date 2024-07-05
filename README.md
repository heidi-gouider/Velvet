# Projet Symfony E-commerce Vente de disques

Table des matières

    Introduction
    Fonctionnalités
    Prérequis
    Installation
    Configuration
    Utilisation
    Tests
    Contribuer
    License
    Crédits


Description de votre projet.

Introduction

Bienvenue dans notre projet de site e-commerce de vente de disques. Ce projet est développé avec Symfony et permet aux utilisateurs de parcourir, rechercher et acheter des disques de musique en ligne.
Fonctionnalités

    Inscription et authentification des utilisateurs
    Parcourir les disques disponibles
    Rechercher des disques par artiste, album, ou genre
    Ajouter des disques au panier
    Passer des commandes
    Consulter l'historique des commandes
    Gestion des utilisateurs et des produits (admin)

Prérequis

    PHP >= 8.3
    Composer
    Symfony CLI
    MySQL ou PostgreSQL

## Installation

Instructions pour installer et configurer le projet.
Installation

    Clonez le dépôt

    bash

git clone https://github.com/votre-utilisateur/votre-repo.git
cd votre-repo

Installez les dépendances

bash

composer install

Configurez votre base de données dans le fichier .env

env

DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

Créez la base de données et les schémas

bash
Attention pour ce projet j'ai décidé de ne plus me servir des migrations mais 
d'utiliser composer.json pour automatiser certaines tâches liées à la bdd :
 Suppression de la base
 Mis à jour des shémas
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Chargez les fixtures (si nécessaire)

bash

    php bin/console doctrine:fixtures:load

Configuration

    Modifiez les paramètres de configuration dans le fichier .env pour adapter le projet à votre environnement (e.g., configurations SMTP pour les emails, clés API, etc.).

Utilisation

    Démarrez le serveur de développement

    bash

    symfony server:start

    Accédez au site via http://localhost:8000

Tests

    Lancez les tests unitaires et fonctionnels

    bash

    php bin/phpunit

Utilisation de owaspzap pour vérifier les failles de sécurité

## Utilisation

Instructions pour utiliser le projet.

## Contribuer

Instructions pour contribuer au projet.
ce projet est en cours de développement et reste un exercice de formation 

## Licence

Information sur la licence du projet.
