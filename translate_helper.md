# Guide de Traduction du Site Keneya

## 🌍 Structure Mise en Place

Le système de traduction multilingue est maintenant configuré pour **Français (FR), Anglais (EN) et Espagnol (ES)**.

### Configuration

- **Locale par défaut**: Français (fr)
- **Locales disponibles**: fr, en, es
- **Middleware**: `SetLocale` - applique automatiquement la langue choisie
- **Controller**: `LocaleController` - gère le changement de langue

### Fichiers de Traduction

Les fichiers de traduction se trouvent dans `lang/{locale}/`:

```
lang/
├── fr/
│   ├── nav.php         ✅ Créé
│   └── common.php      ✅ Créé
├── en/
│   ├── nav.php         ✅ Créé
│   └── common.php      ✅ Créé
└── es/
    ├── nav.php         ✅ Créé
    └── common.php      ✅ Créé
```

## 📝 Comment Utiliser les Traductions

### Dans les vues Blade:

```php
// Syntaxe simple
{{ __('nav.home') }}

// Avec paramètres
{{ __('messages.welcome', ['name' => $user->name]) }}

// Directive Blade
@lang('nav.contact')
```

### Créer un Nouveau Fichier de Traduction

**Exemple: Créer `home.php` pour la page d'accueil**

#### 1. `lang/fr/home.php`:
```php
<?php
return [
    'hero_title' => 'Bienvenue chez Keneya',
    'hero_subtitle' => 'Excellence en santé publique',
    'about_title' => 'À Propos',
    'services_title' => 'Nos Services',
];
```

#### 2. `lang/en/home.php`:
```php
<?php
return [
    'hero_title' => 'Welcome to Keneya',
    'hero_subtitle' => 'Excellence in Public Health',
    'about_title' => 'About',
    'services_title' => 'Our Services',
];
```

#### 3. `lang/es/home.php`:
```php
<?php
return [
    'hero_title' => 'Bienvenido a Keneya',
    'hero_subtitle' => 'Excelencia en Salud Pública',
    'about_title' => 'Acerca de',
    'services_title' => 'Nuestros Servicios',
];
```

### Utiliser dans la Vue

```blade
<h1>{{ __('home.hero_title') }}</h1>
<p>{{ __('home.hero_subtitle') }}</p>
```

## 📂 Fichiers à Créer

Pour compléter la traduction du site, créez ces fichiers:

### Pages Principales:
- [ ] `lang/{locale}/home.php` - Page d'accueil
- [ ] `lang/{locale}/about.php` - À propos
- [ ] `lang/{locale}/activities.php` - Activités
- [ ] `lang/{locale}/news.php` - Actualités
- [ ] `lang/{locale}/team.php` - Équipe
- [ ] `lang/{locale}/contact.php` - Contact
- [ ] `lang/{locale}/footer.php` - Footer

### Sections Spécifiques:
- [ ] `lang/{locale}/forms.php` - Labels de formulaires
- [ ] `lang/{locale}/buttons.php` - Textes des boutons
- [ ] `lang/{locale}/messages.php` - Messages de succès/erreur
- [ ] `lang/{locale}/validation.php` - Messages de validation

## 🔄 Processus de Traduction

### Étape 1: Identifier les Textes
Parcourez chaque vue et identifiez tous les textes statiques.

### Étape 2: Créer les Clés
Organisez les clés de manière logique:
```php
// ❌ Mauvais
'text1' => 'Bienvenue',
'text2' => 'Contactez-nous',

// ✅ Bon
'welcome_message' => 'Bienvenue',
'contact_cta' => 'Contactez-nous',
```

### Étape 3: Remplacer dans les Vues
```blade
<!-- Avant -->
<h1>Bienvenue chez Keneya</h1>

<!-- Après -->
<h1>{{ __('home.welcome_message') }}</h1>
```

### Étape 4: Traduire dans Toutes les Langues
Créez les équivalents en anglais et espagnol.

## 🎯 Fichiers Prioritaires

Commencez par traduire dans cet ordre:

1. ✅ **Navigation** (`nav.php`) - Déjà fait
2. ✅ **Commun** (`common.php`) - Déjà fait
3. **Footer** (`footer.php`) - Très visible
4. **Home** (`home.php`) - Page principale
5. **Contact** (`contact.php`) - Formulaires
6. **About** (`about.php`)
7. **Activities** (`activities.php`)
8. **News** (`news.php`)
9. **Team** (`team.php`)

## 💡 Conseils

1. **Cohérence**: Utilisez les mêmes termes pour les mêmes concepts
2. **Contexte**: Ajoutez des commentaires pour les traductions ambiguës
3. **Pluralisation**: Laravel gère automatiquement les pluriels
4. **Variables**: Utilisez `:variable` pour les valeurs dynamiques

```php
// Avec pluralisation
'apples' => '{0} Aucune pomme|{1} Une pomme|[2,*] :count pommes',

// Avec variables
'welcome' => 'Bienvenue, :name!',
```

## 🚀 Test

Après traduction:
1. Changez la langue dans la navbar
2. Vérifiez que tous les textes changent
3. Testez toutes les pages
4. Vérifiez les formulaires

## 🔧 Commandes Utiles

```bash
# Vider le cache des traductions
php artisan cache:clear

# Publier les fichiers de langue Laravel
php artisan lang:publish
```

## 📧 Contact

Pour toute question sur la traduction, consultez la documentation Laravel:
https://laravel.com/docs/11.x/localization
