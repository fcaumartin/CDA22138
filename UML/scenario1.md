# Enregistrer un emprunt

Description:

Pré-requis:
l'usager est déjà inscrit
le document est référencée

Résultat:
La fiche de l'usager est mise à jour
avec le nouveau document

## Flux nominal

1 > Le personnel demande la création d'un emprunt  
1 < Le système affiche un formulaire pour choisir l'usager  

2 > Le personnel choisit l'usager et valide
2 < Le système affiche les détails de l'usager et un formulaire pour saisir le document

> Le personnel entre le code du document et valide
< Le système affiche les détails du document et si 'l'emprunt est possible

> Le personnel valide l'emprunt
< Le système enregistre l'emprunt et affiche un message de confirmation.




## Flux alternatif

A létape 2, le personnel peut demander la modification des coordonnées.
Le système affiche un formulaire pour saisir les données de l'usager

Le personnel entre et valide
Le système reprend à l'étape suivante...