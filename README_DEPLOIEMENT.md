# 🏗️ GUIDE DE DÉPLOIEMENT COMPLET — ALTHIUM SARL
## Site Officiel V3 — Déploiement FileZilla + Coolify

**Date du package :** 13-10-2026
**Dossier :** `site althuim new 13-10-2026`

---

## 📦 CONTENU DU PACKAGE

```
site althuim new 13-10-2026/
│
├── public/                          ← SITE STATIQUE À DÉPLOYER (prêt à l'emploi)
│   ├── index.html                   (Accueil)
│   ├── a-propos.html                (À Propos & Équipe)
│   ├── metier-single.html           (Nos 6 Activités)
│   ├── realisations.html            (Réalisations / Portefeuille)
│   ├── blog.html                    (Actualités & Blog)
│   ├── contact.html                 (Contact & Devis)
│   ├── mentions-legales.html        (Mentions Légales & RGPD)
│   ├── style.css                    (Design system complet)
│   ├── app.js                       (Interactions & switcher métiers)
│   ├── logo-althium.png             (Logo officiel HD)
│   ├── logo-althium.svg             (Logo vectoriel)
│   └── favicon.svg                  (Favicon officiel)
│
├── wordpress/                       ← FICHIERS POUR INSTALLATION WORDPRESS (optionnel)
│   ├── theme/                       (Thème enfant hello-elementor-child)
│   ├── elementor-templates/         (10 gabarits Elementor Pro)
│   ├── acf-json/                    (5 configurations ACF Pro)
│   ├── data/althium-content-demo.xml (Contenu démo : 6 métiers, réalisations, articles)
│   ├── mu-plugins/althium-core.php  (Plugin fonctionnel CPT)
│   └── assets/                      (Logo & favicon source)
│
├── serve.js                         ← Serveur Node.js (pour Coolify)
├── package.json                     ← Configuration Node.js
├── Dockerfile                       ← Image Docker (pour Coolify)
├── .dockerignore
└── README_DEPLOIEMENT.md            ← Ce fichier
```

---

## 🚀 MÉTHODE 1 : DÉPLOIEMENT VIA FILEZILLA (FTP)

### Étape 1 — Préparer les fichiers
1. Décompressez l'archive `site althuim new 13-10-2026.zip` sur votre ordinateur.
2. Ouvrez le dossier décompressé.
3. Ouvrez le sous-dossier **`public/`**.

### Étape 2 — Connectez-vous avec FileZilla
1. Ouvrez **FileZilla**.
2. Renseignez dans la barre de connexion rapide :
   - **Hôte :** l'adresse FTP de votre hébergeur (ex : `ftp.althium.ci` ou `IP du serveur`)
   - **Identifiant :** votre utilisateur FTP
   - **Mot de passe :** votre mot de passe FTP
   - **Port :** `21` (ou `22` pour SFTP)
3. Cliquez sur **Connexion rapide**.

### Étape 3 — Naviguer vers le dossier web
Dans le panneau **Site distant** (à droite), naviguez vers le dossier racine de votre site :
- **cPanel / hébergement mutualisé :** `public_html/`
- **VPS / dédié :** `/var/www/html/` ou le dossier configuré dans votre serveur web (Nginx/Apache)

### Étape 4 — Transférer les fichiers
1. Dans le panneau **Site local** (à gauche), ouvrez le dossier **`public/`** du package.
2. **Sélectionnez TOUS les fichiers** du dossier `public/` (Ctrl+A).
3. **Glissez-déposez** dans le dossier racine du site distant.
4. Attendez la fin du transfert (indicateur en bas de FileZilla).

### Étape 5 — Vérifier l'affichage
- Ouvrez votre navigateur et allez sur votre domaine (ex : `https://althium.ci`).
- Le site doit s'afficher avec la page d'accueil ALTHIUM SARL.

### ✅ Vérifications FileZilla
- [ ] Tous les fichiers HTML/CSS/JS/PNG/SVG sont présents dans la racine
- [ ] Le fichier `index.html` est bien à la racine
- [ ] Le logo `logo-althium.png` est à la racine
- [ ] Le fichier `style.css` se charge sans erreur

---

## 🚀 MÉTHODE 2 : DÉPLOIEMENT VIA COOLIFY (Docker / Node.js)

### Étape 1 — Préparer le déploiement
1. Décompressez l'archive `site althuim new 13-10-2026.zip`.
2. Connectez-vous à votre panneau **Coolify**.

### Étape 2 — Créer une nouvelle ressource
1. Cliquez sur **New Resource** → **Application**.
2. Choisissez votre méthode de déploiement :
   - **Option A — Git Repository (recommandé) :**
     1. Créez un dépôt Git (GitHub/GitLab) contenant le dossier `site althuim new 13-10-2026/`.
     2. Connectez Coolify à votre dépôt Git.
   - **Option B — Dockerfile direct :**
     1. Sélectionnez **Dockerfile**.
     2. Le `Dockerfile` fourni dans le package détecte automatiquement Node.js.

### Étape 3 — Configurer le build
1. **Build Pack / Dockerfile :** sélectionnez `Dockerfile`.
2. **Port :** `3000` (Coolify détecte automatiquement le `EXPOSE 3000`).
3. **Variables d'environnement :**
   - `PORT` = `3000`
4. **Commande de démarrage :** `node serve.js` (déjà dans le Dockerfile).

### Étape 4 — Déployer
1. Cliquez sur **Deploy**.
2. Attendez que le build se termine (≈ 30-60 secondes).
3. Coolify vous donne une URL de preview (ex : `https://althium.votre-serveur.com`).

### Étape 5 — Configurer le domaine
1. Dans Coolify, allez dans **Settings** → **Domains**.
2. Ajoutez votre domaine (ex : `althium.ci` et `www.althium.ci`).
3. Configurez le **DNS** chez votre registrar :
   - Record **A** : `althium.ci` → IP de votre serveur Coolify
   - Record **CNAME** : `www` → `althium.ci`
4. Activez le **HTTPS automatique** (Let's Encrypt) dans Coolify.

### ✅ Vérifications Coolify
- [ ] Le build Docker réussit sans erreur
- [ ] Le conteneur est en statut **running**
- [ ] L'URL de preview affiche le site ALTHIUM
- [ ] Le domaine personnalisé pointe correctement
- [ ] Le certificat SSL est actif (cadenas vert)

---

## 🎯 CONTENU PAR DÉFAUT QUI S'AFFICHE SUR LE SITE

### Pages (7)
| Page | Fichier | Contenu |
|------|---------|---------|
| Accueil | `index.html` | Hero switcher 6 métiers, chiffres clés, 6 pôles, témoignages, réalisations, blog, CTA |
| À Propos | `a-propos.html` | Histoire, vision, 4 valeurs, équipe, approche 360° |
| Nos 6 Activités | `metier-single.html` | Détail des 6 pôles (BTP, Immo, Conseil&IE, Sport, Formation, Import) |
| Réalisations | `realisations.html` | Portefeuille projets, filtres par pôle, slider avant/après |
| Actualités | `blog.html` | Articles par métier, communiqués, événements |
| Contact | `contact.html` | Formulaire 6 métiers, téléphones CI, Google Maps Abidjan |
| Mentions Légales | `mentions-legales.html` | RGPD, mentions légales, politique de confidentialité |

### Coordonnées intégrées
- 📧 **Emails :** contact@althium.ci / info@althium.ci
- 📞 **Téléphones :** +225 05 56 56 25 24 / +225 07 58 78 32 21
- 💬 **WhatsApp :** +225 05 56 56 25 24
- 📍 **Siège :** Abidjan, Côte d'Ivoire

### Éléments interactifs
- Switcher interactif des 6 secteurs dans le Hero
- Bouton flottant WhatsApp (+225)
- Popup de devis (email + WhatsApp)
- Sticky bar mobile (Appeler / Devis Express)
- Compteurs animés (chiffres clés)
- Formulaire de contact multi-métiers

---

## 🔧 OPTION : INSTALLATION WORDPRESS COMPLÈTE

Si vous souhaitez utiliser la version WordPress (au lieu du statique) :

### Prérequis
- Un serveur avec **PHP 8.0+**, **MySQL 5.7+**, **WordPress** installé
- **Elementor Pro** (licence requise)
- **ACF Pro** (licence requise)

### Étapes
1. Copiez le dossier `wordpress/theme/hello-elementor-child/` dans `wp-content/themes/`.
2. Copiez `wordpress/mu-plugins/althium-core.php` dans `wp-content/mu-plugins/`.
3. Activez le thème **Hello Elementor Child** dans Apparence → Thèmes.
4. Importez les templates Elementor depuis `wordpress/elementor-templates/`.
5. Synchronisez les champs ACF depuis `wordpress/acf-json/`.
6. Importez le contenu démo via `wordpress/data/althium-content-demo.xml` (Outils → Importer).

---

## ❌ DÉPANNAGE COURANT

| Problème | Solution |
|----------|----------|
| Site blanc (404) | Vérifiez que `index.html` est bien à la racine du dossier web |
| Images qui ne s'affichent pas | Vérifiez que `logo-althium.png` et `favicon.svg` sont uploadés |
| CSS non chargé | Vérifiez que `style.css` est à la racine avec les bons droits (644) |
| Coolify build échoue | Vérifiez que le `Dockerfile` et `package.json` sont présents |
| Port 3000 occupé | Modifiez la variable `PORT` dans Coolify ou serve.js |
| Certificat SSL non actif | Attendez 5 min, vérifiez que le DNS pointe bien vers le serveur |

---

## 📞 SUPPORT
- **Email :** contact@althium.ci
- **Téléphone :** +225 05 56 56 25 24

*Package généré le 13-10-2026 — ALTHIUM SARL © 2026*
