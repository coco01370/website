<?php

//Cette fonction permet de faire une redirection lorsque l'utilisateur se déconnecte de son profil
/**
 * @param string $location
 * @return void
 */
function redirect(string $location){
    header('Location: ' . $location);
    exit;
}
