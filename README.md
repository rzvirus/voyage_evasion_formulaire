##  Voyage Évasion Version Symfony – README

###  Présentation

**Voyage Évasion** est une application web Symfony immersive destinée à présenter les plus belles destinations du monde. Le site propose :

* des pages par continent,
* des fiches pays détaillées,
* une page "À la une" avec des événements récents,
* une navigation fluide et responsive,
* un design personnalisé avec un CSS et JS dédié à chaque page.

---

###  Arborescence principale

```
voyage_evasion/
├── assets/
│   ├── app.js
│   ├── styles/
│   │   ├── app.css
│   │   ├── alaune.css
│   │   ├── [pays].css  ← (france.css, espagne.css, etc.)
│   ├── pays/
│   │   ├── alaune.js
│   │   ├── france.js
│   │   ├── espagne.js
│   │   ├── ...
├── public/
│   ├── build/
│   ├── images/
│   ├── audio/
├── src/
│   └── Controller/
│       └── PageController.php
├── templates/
│   ├── base.html.twig
│   ├── home/
│   │   └── index.html.twig
│   ├── pages/
│   │   ├── alaune.html.twig
│   │   ├── destinations.html.twig
│   │   ├── contact.html.twig
│   │   ├── about.html.twig
│   │   ├── login.html.twig
│   │   └── register.html.twig
│   ├── pays/
│   │   ├── france.html.twig
│   │   ├── espagne.html.twig
│   │   ├── italie.html.twig
│   │   ├── japon.html.twig
│   │   ├── thailande.html.twig
│   │   ├── ...
├── webpack.config.js
├── package.json
└── README.md
```

---

###  Technologies utilisées

* **Symfony 6+**
* **Twig**
* **Webpack Encore**
* **HTML / CSS / JS**
* **Google Fonts**
* **Audio, galeries, animation**

---

###  Installation du projet

#### 1. Cloner le projet :

```bash
git clone https://github.com/rzvirus/voyage-evasion-symfony.git
cd voyage_evasion_symfony
```

#### 2. Installer les dépendances JavaScript :

```bash
npm install
```

#### 3. Lancer le serveur Symfony :

```bash
symfony server:start
```

#### 4. Compiler les assets :

```bash
npm run dev        # en développement
npm run build      # en production
```

---

###  Structure des pages

Chaque page pays possède :

* un fichier `.html.twig` dans `templates/pays/`
* un fichier `.css` dans `assets/styles/`
* un fichier `.js` dans `assets/pays/`, qui importe son CSS
* une variable `page_asset` dans le fichier Twig :

  ```twig
  {% set page_asset = 'pays/france' %}
  ```

---

###  Fonctionnement de Webpack Encore

* Le fichier `webpack.config.js` contient toutes les entrées `.addEntry('pays/france', './assets/pays/france.js')` générées automatiquement.
* Le fichier `base.html.twig` charge dynamiquement les bons fichiers JS/CSS :

  ```twig
  {% if page_asset is defined %}
    {{ encore_entry_link_tags(page_asset) }}
    {{ encore_entry_script_tags(page_asset) }}
  {% endif %}
  ```

---

###  Routes gérées (extrait de PageController.php)

* `/` → Accueil
* `/alaune` → À la une
* `/contact`, `/connexion`, `/inscription`, `/quisommesnous` → pages diverses
* `/destinations`, `/europe`, `/asie`, `/amerique`, etc.
* `/france`, `/espagne`, `/italie`, `/japon`, etc.

---

###  Astuces

* Si une page affiche une erreur 500 concernant `page_asset`, assure-toi que le fichier `.js` existe dans `assets/pays/` et qu’il est bien importé dans `webpack.config.js`.
* En cas de modification de structure : toujours relancer `npm run build`.

---

###  Auteur

Projet développé par **Mohamed Moussaoui** dans le cadre de sa formation en développement web.
