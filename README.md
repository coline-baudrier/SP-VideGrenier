# Vide Grenier en Ligne

Ce Readme.md est à destination des futurs repreneurs du site-web Vide Grenier en Ligne.

## Contexte du projet
Le projet s'inscrit dans le cadre d'un projet CUBE au CESI de Brest. Une demande a été faite à propos d'un site internet de vide grenier en ligne. 
Le propriétaire de l'entreprise nous a donc fourni une liste de choses à régler et demander de faire une passe sur tout le site pour vérfier le bon fonctionnement. 

Le but de ce projet est donc : 
- Réaliser le débuggage complet du site
- Réaliser le projet en utilisant Docker 
- Réaliser le projet en utilisant le principe de CI/CD
- Réaliser des .sh 
- Faire des tests unitaires

Une présentation orale de 20 minutes sera à réaliser et devra montrer : 
- Démonstration de tests unitaires
- Démonstration de la correction des bugs du site
- Développement en live d'une requête API qui respectera le Gitflow, c'est à dire
  - Environnement de développement à jour mais environnement pré-prod et prod sur l'ancienne version
  - Mettre à jour l'environnement de pré-production, l'environnement de production doit être sur l'ancienne version
  - Mettre à jour l'environnement de production au regarde de l'environnement de pré-production

## Gestion du projet
### Technologies
- **Site internet** : PHP et Bootstrap
- **Base de données** : MySQL
- **Environnements** : Docker
- **Versionning** : Gitlab
- **CI/CD** : Gitlab
- **Suivi de projet** : Fichier Excel + Gitlab

### Liste de tâches principales
- [x] Création d'un repository
- [ ] Système de gestion des issues 
- [ ] Répartition des tâches
- [ ] Travailler en mode Gitflow
- [ ] Environnement de développement basé sur Docker
- [ ] Apporter les corrections au site internet
- [ ] Créer les tests unitaires de l'application
- [ ] Concevoir un environnement de pré-production Docker 
  - Container pour BDD persistente
  - Container pour serveur Web : récupère la branch **Stage** 
- [ ] Utiliser le principe de merge request pour envoyer la branch **Stage** vers la branch **Master**
- [ ] Concevoir un environnement de production basé sur Docker :
  - Container pour BDD persistente
  - Container pour serveur Web : récupère la branch **Master**
- [ ] Utilisation d'un système de génération documentaire pour le code API

## Initialisation du projet
### Mise en place du projet back-end
1. Créez un VirtualHost pointant vers le dossier /public du site web (Apache)
2. Importez la base de données MySQL (sql/import.sql)
3. Connectez le projet et la base de données via les fichiers de configuration
4. Lancez la commande `composer install` pour les dépendances

### Mise en place du projet front-end
1. Lancez la commande `npm install` pour installer node-sass
2. Lancez la commande `npm run watch` pour compiler les fichiers SCSS

### Routing
Le [Router](Core/Router.php) traduit les URLs. 

Les routes sont ajoutées via la méthode `add`. 

En plus des **controllers** et **actions**, vous pouvez spécifier un paramètre comme pour la route suivante:

```php
$router->add('product/{id:\d+}', ['controller' => 'Product', 'action' => 'show']);
```

### Vues
Les vues sont rendues grâce à **Twig**. 
Vous les retrouverez dans le dossier `App/Views`. 

```php
View::renderTemplate('Home/index.html', [
    'name'    => 'Toto',
    'colours' => ['rouge', 'bleu', 'vert']
]);
```
### Models
Les modèles sont utilisés pour récupérer ou stocker des données dans l'application. Les modèles héritent de `Core
\Model
` et utilisent [PDO](http://php.net/manual/en/book.pdo.php) pour l'accès à la base de données. 

```php
$db = static::getDB();
```
## Initialisation des environnements Docker
### Environnement de développement
### Environnement de préproduction
### Environnement de production 