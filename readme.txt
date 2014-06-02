Introduction
------------

	Projet de développement d'une application web de gestion de questions-réponses basée sur le modèle de StackOverflow.
	Réalisé par Maxime Peterlin et Gabriel Vermeulen.
	L'application a été développée à l'aide du framework HTML/CSS Bootstrap, du framework PHP CodeIgniter et de la bibliothèque JavaScript jQuery.


Connexion
---------
	
	Pour se connecter les identifiants sont les couples :
		- max@max.max / maxmax ;
		- bob@bob.bob / bobbob .



Fonctionnalités
---------------

	1. Inscription
		Le mot de passe est chiffré en MD5 dans la base de données.
		Lors de l'inscription d'un utilisateur une couleur aléatoire faisant office d'avatar leur est attribuée.
	2. Authentification
	3. Ajout, édition de questions
	4. Ajout, édition de réponses
	5. Vote pour des réponses et des questions
		On peut voter pour la question en tant que telle (elle est dissociée des réponses au niveau du vote),
		mais on ne peut voter que pour une seule réponse.
	6. Écran d'accueil
		Lorsque l'utilisateur est connecté, il peut également voir les questions les plus récentes, les plus populaires de la semaine et les plus populaires du mois.
		Il a également un récapitulatif des votes positifs et négatifs qu'il a donné et reçu.
	7. Affichage des questions et des réponses
	8. Un compteur de vues est associé à chaque question. Ce dernier s'incrémente à chaque fois qu'un utilisateur visite une nouvelle question (i.e. qu'il n'avait jamais visité avant).
	9. Affichage des questions
		Il est possible d'afficher toutes les questions en les triant selon certains critères, qui sont :
			- l'ancienneté ;
			- le nombre de réponses ;
			- le nombre de votes positifs ;
			- le nombre de vues.
		Les résultats sont affichés avec une pagination.


Architecture
------------
	
	Ci-dessous seront listés uniquement les fichiers ajoutés à l'architecture de départ de CodeIgniter (sauf s'ils ont été, au préalable, modifiés et seront alors suivis de [CI]).
	
	/
	|
	+---application/
	|   |
	|   +---config/
	|   |   |
	|   |   +---config.php [CI]
	|   |   |		Permet de modifier notamment l'URL de base du site (par défaut localhost), les suffixes des URL, la 
	|   |   |		langue du site pour les erreurs, etc...
	|   |   |
	|   |   +---database.php [CI]
	|   |   		Permet de modifier les variables propres à la connexion à la base de données
	|   |   
	|   +---controllers/
	|   |   |
	|   |   +---welcome.php
	|   |   |		Controlleur utilisé pour l'affichage de la page d'accueil, l'authentification et la connexion des 
	|   |   |		utilisateurs. Elle affiche le contenu seulement si l'utilisateur est loggé.
	|   |   |
	|   |   +---ask.php
	|   |   		Controlleur utilisé pour l'affichage, la création, la suppression et l'édition des questions et 
	|   |   		réponses.
	|   |   		Il sert également à afficher une liste de question en fonction de certains critères (cf. 
	|   |   		Fonctionnalités - 8).
	|   |
	|   +---models/ 
	|   |   |
	|   |   +---ask_model.php
	|   |   |		Modèle utilisé pour la gestion des questions et des réponses. 
	|   |   |
	|   |   +---user_model.php
	|   |   |		Modèle utilisé pour la gestion des utilisateurs. 
	|   |   |
	|   |   +---views_model.php
	|   |   |		Modèle utilisé pour la gestion des vues. 
	|   |   |
	|   |   +---votes_model.php
	|   |   		Modèle utilisé pour la gestion des votes. 
	|   |
	|   +---views/
	|       |
	|       +---template.php
	|       |		Vue de base contenant le header et le footer. Le contenu à afficher est dicté par le controlleur. 
	|       |
	|       +---Misc/
	|       |		Dossier contenant des pages réutilisables qui sont ensuite incluses. On a le header, le  
	|       |		footer et l'overlay.
	|       |
	|       +---Home/
	|       |		Dossier contenant la vue propre à la page d'accueil. 
	|       |
	|       +---Ask/
	|       		Dossier contenant les vues dédiées à l'affichage des questions/réponses. 
	|      
	|      
	+---assets/
	    |
	    +---css/ : dossier contenant les fichiers .css propres à Bootstrap, ainsi que la feuille de style du site.
	    |   |
	    |   |
	    |   +---design.css
	    |   		Feuille de style du site 
	    |   
	    +---js/ : dossier contenant les fichiers .js propres à Bootstrap, ainsi que les scripts javascript 
	    |   |	 implémentés par notre groupe.
	    |   |
	    |   |
	    |   +---script.js
	    |   		Fichier contenant les scripts javascript implémentés par notre groupe.
	    |   	
	    +---fonts/ : dossier contenant les fichiers de police propres à bootstrap.
	    |   	
	    +---img/ : dossier contenant les images du site.

