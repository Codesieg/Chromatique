# Dictionnaire de données

## Utilisateurs (`app_user`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de notre utilisateur|
|email|VARCHAR(64)|NOT NULL, UNIQUE|L'email de l'utilisateur|
|password|VARCHAR(64)|NOT NULL|Le mot de passe de l'utilisateur|
|pseudo|VARCHAR(64)|NOT NULL|Le pseudo de l'utilisateur|
|avatar|VARCHAR(64)|NULL|La photo d'avatar de l'utilisateur|
|role|ENUM('admin', 'reader', 'dev', 'uploader')|NOT NULL, DEFAULT 'reader'|Le rôle de l'utilisateur|
|status|TINYINT(3)|NOT NULL, DEFAULT 0|Le statut de l'utilisateur (1=actif, 2=désactivé/bloqué)|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du compte utilisateur|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de l'utilisateur|

## Historique de l'Utilisateurs (`user_history`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du log de l'utilisateur|
|id_user|INT|NOT NULL|L'ID de l'utilisateur faisant référence à la table app_user|
|id_manga|INT|NOT NULL|identifiant du manga faisant référence à la table manga|
|id_chapter|INT|NOT NULL|identifiant du chapitre faisant référence à la table manga_chapter|
|id_tome|INT|NOT NULL|identifiant du tome faisant référence à la table tomes|
|id_page|INT|NOT NULL|identifiant du tome faisant référence à la table manga_pages|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du compte utilisateur|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de l'utilisateur|


## Mangas

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du manga|
|manga_name|VARCHAR(45)|NOT NULL|Le nom du manga|
|author|VARCHAR(45)|NULL|L'auteur du manga|
|synopsis|MEDIUMTEXT|NULL|Résumé du manga|
|manga_jacket|VARCHAR(45)|NOT NULL|Couverture du manga|
|manga_banner|VARCHAR(45)|NOT NULL|Bannière de page du manga|
|created_at|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP|La date de création de l'ajout du manga|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du manga|

## Tomes

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du tome|
|tome_name|VARCHAR(45)|NOT NULL, UNIQUE|Le titre du tome|
|views|INT|NULL|Nombre de vue du manga|
|rankings|INT|NULL|Note du manga|
|tome_jacket|VARCHAR(45)|NULL|Note du manga|
|tome_number|INT|NOT NULL|Numero du tome|
|id_manga|INT|NOT NULL|id du manga faisant référence à la table mangas|
|id_uploader|INT|NOT NULL|id de l'utilisateur ayant le grade uploader faisant référence à la table app_user|
|created_at|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP|La date de création de l'ajout du tome|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du tome|

## Chapitre d'un tome (`chapters`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du chapitre|
|chapter_name|VARCHAR(64)|NOT NULL|Le nom du chapitre|
|chapter_number|INT|NOT NULL|Le numero du chapitre|
|id_tome|INTNOT NULL|id du tome faisant référence à la table tomes|
|created_at|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP|La date de création du chapitre|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du chapitre|

## Page d'un chapitre(`pages`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la page|
|page_name|VARCHAR(64)|NOT NULL|Le nom de la page|
|page_number|INT|NOT NULL|Le numero de la page|
|id_chapter|INTNOT NULL|id du chapitre faisant référence à la table chapters|
|created_at|TIMESTAMP|DEFAULT CURRENT_TIMESTAMP|La date de création du type|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour du type|
