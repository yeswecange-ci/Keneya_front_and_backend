# Guide de Déploiement - Keneya

Ce guide vous aide à déployer correctement le site Keneya sur un serveur de production avec tous les styles et assets fonctionnels.

## 🎯 Problème identifié

Le site utilise deux systèmes pour les styles :
1. **Frontend public** : CSS statiques dans `public/css/`
2. **Dashboard admin** : Vite + Tailwind (compilé dans `public/build/`)

## 📋 Prérequis sur le serveur

- PHP 8.1 ou supérieur
- Composer
- Node.js 16+ et npm
- Base de données MySQL
- Serveur web (Apache/Nginx)

## 🚀 Méthode 1 : Déploiement automatique (Recommandé)

### Sur votre machine locale

1. **Compiler les assets avant de déployer** :
```bash
npm run build
```

### Sur le serveur

1. **Téléverser tous les fichiers** (y compris le dossier `public/build/`)

2. **Exécuter le script de déploiement** :
```bash
chmod +x deploy.sh
bash deploy.sh
```

## 🔧 Méthode 2 : Déploiement manuel étape par étape

### 1. Téléverser les fichiers sur le serveur

**IMPORTANT** : Assurez-vous de téléverser TOUS ces dossiers :
```
✅ app/
✅ bootstrap/
✅ config/
✅ database/
✅ public/
   ├── css/          ← IMPORTANT : tous les fichiers CSS
   ├── js/           ← IMPORTANT : tous les fichiers JS
   ├── images/       ← IMPORTANT : toutes les images
   ├── build/        ← IMPORTANT : assets compilés par Vite
   └── storage/      ← Sera un lien symbolique
✅ resources/
✅ routes/
✅ storage/
✅ vendor/
✅ .env              ← À créer/modifier sur le serveur
```

### 2. Configurer le fichier .env sur le serveur

```bash
cp .env.example .env
nano .env
```

**Paramètres critiques** :
```env
APP_NAME=Keneya
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### 3. Installer les dépendances

```bash
# Dépendances PHP (sans dev)
composer install --optimize-autoloader --no-dev

# Dépendances Node.js
npm install

# Compiler les assets pour production
npm run build
```

### 4. Configuration Laravel

```bash
# Générer la clé d'application
php artisan key:generate

# Créer le lien symbolique storage
php artisan storage:link

# Migrer la base de données
php artisan migrate --force

# (Optionnel) Peupler avec des données
php artisan db:seed --force
```

### 5. Optimiser pour la production

```bash
# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimiser
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Optimiser Composer
composer dump-autoload --optimize
```

### 6. Configurer les permissions

```bash
# Permissions pour les dossiers d'écriture
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Ou selon votre configuration serveur
chmod -R 775 storage bootstrap/cache
```

## 🔍 Vérifications après déploiement

### 1. Vérifier que les dossiers existent

```bash
ls -la public/build/        # Doit contenir assets/
ls -la public/css/          # Doit contenir main.css, bootstrap.min.css, etc.
ls -la public/js/           # Doit contenir les fichiers JS
ls -la public/storage/      # Doit être un lien symbolique
```

### 2. Vérifier le contenu du dossier build

```bash
ls -la public/build/assets/
```

Vous devez voir :
- `app-XXXXXX.css` (fichier CSS compilé par Vite)
- `app-XXXXXX.js` (fichier JS compilé par Vite)
- `manifest.json`

### 3. Vérifier le lien symbolique storage

```bash
ls -la public/storage
```

Doit afficher : `public/storage -> ../storage/app/public`

Si ce n'est pas le cas :
```bash
rm -rf public/storage
php artisan storage:link
```

### 4. Tester les URLs d'assets

Ouvrez votre navigateur et testez ces URLs :

**Frontend (CSS statiques)** :
- `https://votre-domaine.com/css/main.css` ✅
- `https://votre-domaine.com/css/bootstrap.min.css` ✅
- `https://votre-domaine.com/js/main.js` ✅

**Dashboard (Vite assets)** :
- `https://votre-domaine.com/build/manifest.json` ✅
- `https://votre-domaine.com/build/assets/app-XXXXX.css` ✅
- `https://votre-domaine.com/build/assets/app-XXXXX.js` ✅

**Images via storage** :
- `https://votre-domaine.com/storage/images/test.jpg` ✅

### 5. Vérifier les logs d'erreur

```bash
tail -f storage/logs/laravel.log
```

## 🐛 Dépannage

### Problème : Les styles du frontend ne s'appliquent pas

**Solution** :
1. Vérifiez que TOUS les fichiers CSS sont dans `public/css/` sur le serveur
2. Vérifiez les permissions : `chmod 755 public/css/`
3. Vérifiez que les chemins dans le code pointent vers `/css/` et non `../css/`
4. Videz le cache du navigateur (Ctrl+Shift+R)

### Problème : Les styles du dashboard ne s'appliquent pas

**Solution** :
1. Vérifiez que `public/build/` existe et contient `assets/`
2. Recompilez les assets : `npm run build`
3. Videz le cache Laravel : `php artisan cache:clear`
4. Videz le cache du navigateur

### Problème : Images manquantes

**Solution** :
1. Vérifiez le lien symbolique : `php artisan storage:link`
2. Vérifiez les permissions : `chmod -R 755 storage/app/public`
3. Vérifiez que les images sont bien dans `storage/app/public/`

### Problème : Erreur 500

**Solution** :
1. Vérifiez le fichier `.env`
2. Vérifiez les permissions : `chmod -R 775 storage bootstrap/cache`
3. Videz tous les caches
4. Consultez les logs : `tail -f storage/logs/laravel.log`

### Problème : Page blanche

**Solution** :
1. Activez temporairement le debug : `APP_DEBUG=true` dans `.env`
2. Rechargez la page pour voir l'erreur
3. Corrigez l'erreur
4. Remettez `APP_DEBUG=false`

## 📝 Configuration Apache (.htaccess)

Si vous utilisez Apache, assurez-vous que le fichier `public/.htaccess` existe :

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## 📝 Configuration Nginx

Si vous utilisez Nginx, exemple de configuration :

```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    root /chemin/vers/keneya/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## ✅ Checklist finale

Avant de mettre en production, vérifiez :

- [ ] `.env` configuré avec `APP_ENV=production` et `APP_DEBUG=false`
- [ ] Tous les fichiers téléversés (y compris `public/build/`, `public/css/`, `public/js/`)
- [ ] `composer install --no-dev` exécuté
- [ ] `npm run build` exécuté
- [ ] `php artisan storage:link` exécuté
- [ ] `php artisan config:cache` exécuté
- [ ] `php artisan route:cache` exécuté
- [ ] `php artisan view:cache` exécuté
- [ ] Permissions correctes (755 pour storage et bootstrap/cache)
- [ ] Base de données migrée
- [ ] Tests effectués sur les pages frontend et dashboard
- [ ] Cache du navigateur vidé lors des tests

## 🆘 Support

Si vous rencontrez toujours des problèmes :
1. Vérifiez les logs Laravel : `storage/logs/laravel.log`
2. Vérifiez les logs du serveur web (Apache/Nginx)
3. Testez en local d'abord avec `APP_ENV=production` pour reproduire l'environnement

---

**Date de création** : 2025-12-02
**Version Laravel** : 12.x
**Version Vite** : 7.0.4
