# Mon site WordPress

Ce dépôt contient le **thème personnalisé** et les **plugins développés sur mesure** pour mon site WordPress.  
Le but est de versionner le code utile, sans les fichiers volumineux ni les données sensibles.

## 📦 Structure du dépôt

wp-content/
themes/
mon-theme/
plugins/
mon-plugin-custom/

markdown
Copier
Modifier

## 🚀 Installation locale

1. **Installer WordPress**

    - Télécharger WordPress depuis [wordpress.org](https://wordpress.org/download/)
    - Décompresser dans votre dossier de travail

2. **Cloner ce dépôt**
    ```bash
    git clone https://github.com/<ton-utilisateur>/<ton-repo>.git
    Puis copier wp-content/themes et wp-content/plugins dans l’installation WordPress.
    ```

Importer la base de données

Utiliser un export .sql depuis phpMyAdmin de l’hébergement original.

Mettre à jour les URL via un outil comme Better Search Replace.

Configurer wp-config.php

Créer un wp-config.php basé sur wp-config-sample.php

Ajouter vos identifiants de base de données et clés de sécurité.

Lancer le site

Accéder à l’URL locale (ex: http://localhost)

##🔒 Sécurité
Les fichiers sensibles (wp-config.php, .env) ne sont pas inclus dans ce dépôt.

Les images et médias sont exclus pour réduire la taille du dépôt.
