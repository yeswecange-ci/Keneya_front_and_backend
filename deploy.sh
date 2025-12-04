#!/bin/bash

# Script de déploiement pour Keneya
# Usage: bash deploy.sh

echo "🚀 Début du déploiement de Keneya..."

# 1. Installer les dépendances PHP
echo "📦 Installation des dépendances PHP..."
composer install --optimize-autoloader --no-dev

# 2. Installer les dépendances Node.js
echo "📦 Installation des dépendances Node.js..."
npm install

# 3. Compiler les assets pour la production
echo "🔨 Compilation des assets Vite pour la production..."
npm run build

# 4. Vider et recréer le cache Laravel
echo "🧹 Nettoyage du cache Laravel..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Optimiser Laravel pour la production
echo "⚡ Optimisation de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Créer le lien symbolique pour le storage
echo "🔗 Création du lien symbolique storage..."
php artisan storage:link

# 7. Optimiser Composer
echo "⚡ Optimisation de l'autoloader Composer..."
composer dump-autoload --optimize

# 8. Définir les permissions correctes
echo "🔐 Configuration des permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo ""
echo "✅ Déploiement terminé avec succès !"
echo ""
echo "📋 Vérifications à faire manuellement sur le serveur :"
echo "   1. Vérifier que le fichier .env existe et est correctement configuré"
echo "   2. Vérifier que APP_ENV=production dans .env"
echo "   3. Vérifier que APP_DEBUG=false dans .env"
echo "   4. Vérifier les permissions des dossiers (storage et bootstrap/cache)"
echo "   5. Vérifier que le dossier public/build existe et contient les assets"
echo "   6. Vérifier que le dossier public/storage est un lien symbolique vers storage/app/public"
echo ""
