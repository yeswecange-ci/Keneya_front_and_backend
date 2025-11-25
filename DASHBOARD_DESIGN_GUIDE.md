# 🎨 Guide du Nouveau Design Dashboard Admin - Keneya

## 📋 Table des Matières
1. [Vue d'ensemble](#vue-densemble)
2. [Mise à jour des vues existantes](#mise-à-jour-des-vues-existantes)
3. [Composants disponibles](#composants-disponibles)
4. [Classes CSS utilitaires](#classes-css-utilitaires)
5. [JavaScript personnalisé](#javascript-personnalisé)
6. [Exemples de code](#exemples-de-code)

---

## 🎯 Vue d'ensemble

Le nouveau design du dashboard admin est construit avec **TailwindCSS** et offre :
- ✅ Design moderne et épuré
- ✅ Interface responsive (mobile, tablet, desktop)
- ✅ Sidebar fixe avec navigation claire
- ✅ Navbar professionnelle avec profil utilisateur
- ✅ Composants réutilisables
- ✅ Animations fluides
- ✅ Page de connexion redessinée avec logo

---

## 🔄 Mise à jour des vues existantes

### Étape 1 : Changer le layout

**Ancien code :**
```blade
@extends('layouts.backend.app')
```

**Nouveau code :**
```blade
@extends('layouts.admin')

@section('title', 'Titre de la page')
@section('page-title', 'Nom pour le breadcrumb')
```

### Étape 2 : Structure de la page

```blade
@extends('layouts.admin')

@section('title', 'Gestion des Articles')
@section('page-title', 'Articles')

@section('content')
<div class="space-y-6">
    <!-- Header de la page -->
    <div class="page-header">
        <h1 class="page-title">Gestion des Articles</h1>
        <p class="page-description">Gérez tous vos articles depuis cette interface</p>
    </div>

    <!-- Votre contenu ici -->
    <div class="dashboard-card">
        <!-- Contenu de la carte -->
    </div>
</div>
@endsection
```

---

## 🧩 Composants disponibles

### 1. Cards (Cartes)

#### Card Basique
```html
<div class="dashboard-card">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Titre de la carte</h2>
    <p class="text-gray-600">Contenu de la carte</p>
</div>
```

#### Card avec Header et Actions
```html
<div class="dashboard-card">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900">Titre</h2>
        <button class="btn-primary">Action</button>
    </div>
    <div>Contenu</div>
</div>
```

### 2. Stats Cards (Cartes Statistiques)

```html
<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-blue-100 text-sm font-medium mb-1">Label</p>
            <h3 class="text-3xl font-bold">1,234</h3>
        </div>
        <div class="bg-white bg-opacity-20 rounded-full p-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <!-- Icône SVG -->
            </svg>
        </div>
    </div>
</div>
```

**Couleurs disponibles :**
- `from-blue-500 to-blue-600` - Bleu
- `from-green-500 to-green-600` - Vert
- `from-purple-500 to-purple-600` - Violet
- `from-orange-500 to-orange-600` - Orange
- `from-red-500 to-red-600` - Rouge

### 3. Tables

```html
<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <button class="btn-primary">Modifier</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
```

### 4. Boutons

```html
<!-- Bouton Primaire -->
<button class="btn-primary">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <!-- Icône -->
    </svg>
    Texte du bouton
</button>

<!-- Bouton Secondaire -->
<button class="btn-secondary">Action Secondaire</button>

<!-- Bouton Danger -->
<button class="btn-danger">Supprimer</button>

<!-- Bouton Success -->
<button class="btn-success">Valider</button>
```

### 5. Formulaires

```html
<form action="" method="POST" class="space-y-6">
    @csrf

    <!-- Groupe de formulaire -->
    <div class="form-group">
        <label class="form-label">Nom</label>
        <input type="text" name="name" class="form-input" placeholder="Entrez le nom">
        @error('name')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-textarea"></textarea>
    </div>

    <!-- Select -->
    <div class="form-group">
        <label class="form-label">Catégorie</label>
        <select name="category" class="form-select">
            <option value="">Choisir...</option>
            <option value="1">Catégorie 1</option>
        </select>
    </div>

    <!-- Boutons d'action -->
    <div class="flex justify-end space-x-3">
        <button type="button" class="btn-secondary">Annuler</button>
        <button type="submit" class="btn-primary">Enregistrer</button>
    </div>
</form>
```

### 6. Badges

```html
<span class="badge badge-success">Actif</span>
<span class="badge badge-danger">Inactif</span>
<span class="badge badge-warning">En attente</span>
<span class="badge badge-info">Info</span>
```

### 7. Alerts (Messages)

Les alertes sont déjà gérées automatiquement dans le layout pour les messages `success` et `error`.

Pour afficher un message :
```php
return redirect()->back()->with('success', 'Opération réussie !');
return redirect()->back()->with('error', 'Une erreur est survenue.');
```

### 8. Empty States (États vides)

```html
<div class="empty-state">
    <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <!-- Icône -->
    </svg>
    <h3 class="empty-state-title">Aucun élément</h3>
    <p class="empty-state-description">Commencez par créer votre premier élément</p>
    <button class="btn-primary mt-4">Créer</button>
</div>
```

---

## 🎨 Classes CSS utilitaires

### Layout
- `space-y-6` - Espacement vertical entre éléments
- `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6` - Grille responsive

### Headers de page
- `page-header` - Container du header
- `page-title` - Titre de la page
- `page-description` - Description de la page

### Cards
- `dashboard-card` - Card basique
- `stat-card` - Card pour statistiques

### Text
- `text-muted` - Texte grisé
- `truncate-2-lines` - Tronquer texte sur 2 lignes

---

## 📜 JavaScript personnalisé

### Fonctions utilitaires disponibles

#### Afficher une notification toast
```javascript
showToast('Message de succès', 'success');
showToast('Message d\'erreur', 'error');
showToast('Information', 'info');
```

#### Formater un nombre
```javascript
formatNumber(1234567); // Retourne "1 234 567"
```

#### Formater une date
```javascript
formatDate('2024-01-15'); // Retourne "15 janv. 2024"
formatDate('2024-01-15', 'long'); // Retourne "15 janvier 2024, 00:00"
```

### Fonctionnalités automatiques

- **Messages auto-masquables** : Les messages success/error disparaissent après 5 secondes
- **Confirmation de suppression** : Ajoutez `data-confirm-delete="Message personnalisé"` sur un bouton
- **Prévisualisation d'images** : Automatique sur les inputs `type="file" accept="image/*"`
- **Mobile sidebar** : Toggle automatique sur mobile

---

## 💡 Exemples de code

### Exemple complet d'une page de liste

```blade
@extends('layouts.admin')

@section('title', 'Liste des Articles')
@section('page-title', 'Articles')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="page-header">
            <h1 class="page-title">Articles</h1>
            <p class="page-description">{{ $articles->count() }} articles au total</p>
        </div>
        <a href="{{ route('articles.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nouvel article
        </a>
    </div>

    <!-- Table -->
    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td class="font-medium">{{ $article->title }}</td>
                        <td>{{ $article->category }}</td>
                        <td>
                            <span class="badge {{ $article->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $article->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td class="text-gray-500">{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-confirm-delete="Supprimer cet article ?" class="text-red-600 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="empty-state">
                                <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="empty-state-title">Aucun article</h3>
                                <p class="empty-state-description">Commencez par créer votre premier article</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
```

---

## 🚀 Prochaines étapes

1. Mettez à jour vos vues une par une en utilisant `@extends('layouts.admin')`
2. Utilisez les classes CSS utilitaires pour styliser vos contenus
3. Profitez des fonctions JavaScript automatiques
4. Consultez la vue exemple : `resources/views/admin/analytics/dashboard-new.blade.php`

---

## 📞 Support

Pour toute question concernant le nouveau design, consultez ce guide ou référez-vous aux exemples de code fournis.

**Fichiers principaux :**
- Layout : `resources/views/layouts/admin.blade.php`
- Sidebar : `resources/views/partials/admin/sidebar.blade.php`
- Navbar : `resources/views/partials/admin/navbar.blade.php`
- CSS : `public/css/admin-dashboard.css`
- JS : `public/js/admin-dashboard.js`

---

© 2024 Keneya Impact - Dashboard Admin Design
