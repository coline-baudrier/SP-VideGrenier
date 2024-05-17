#!/bin/bash

# Variables pour Gitlab
REPO_URL="https://gitlab.com/projets-cube/vide-grenier.git"
BRANCH="main"
DEST_DIR="/var/www/html/prod"
TEMP_DIR="/tmp/repo"

# Nettoyer le répertoire de destination s'il existe et n'est pas vide
if [ -d "$DEST_DIR" ] && [ "$(ls -A $DEST_DIR)" ]; then
  echo "Nettoyage du répertoire $DEST_DIR..."
  rm -rf "${DEST_DIR:?}"/*  # Utilisation de guillemets pour gérer les espaces potentiels dans les chemins
fi

# Nettoyer le répertoire temporaire s'il existe
if [ -d "$TEMP_DIR" ]; then
  rm -rf "${TEMP_DIR}"  # Utilisation de guillemets ici aussi
fi

# Cloner le dépôt dans le répertoire temporaire
git clone --single-branch --branch $BRANCH $REPO_URL $TEMP_DIR

# Vérifier si index.php existe dans le répertoire public
if [ ! -f "$TEMP_DIR/public/index.php" ]; then
  echo "index.php n'existe pas dans le répertoire cloné."
  exit 1
fi

# Copier le contenu du dossier public vers le répertoire de destination
cp -r "$TEMP_DIR/public/"* "$DEST_DIR"  # Ajout de guillemets pour sécuriser les chemins

# Option : installer les dépendances, etc.
# Les commandes suivantes sont commentées, décommentez-les si nécessaire
#cd "$TEMP_DIR"  # Ajout de guillemets
# composer install
# php artisan migrate

# Lancer Apache
apache2-foreground
