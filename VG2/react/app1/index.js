// Les deux premières lignes chargent les bibliothèques nécéssaires au projet.
import React from 'react'
import { createRoot } from 'react-dom/client';

// Composant React
import { Composant } from './composant';

// Dans votre template twig, un élément html doit s'appeler #app. 
// Il contiendra l'application
const container = document.getElementById('app')

// Création de l'application
const root = createRoot(container);
root.render(<Composant nom="toto" prenom="titi"></Composant>);