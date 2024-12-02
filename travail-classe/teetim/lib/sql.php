<?php
// "Librairie" de fonctions pour manipuler les données MySQL
// avec MySQLi.
const HOTE = "localhost";
const UTIL = "root";
const MDP =  "";
const BD_NOM = "teetim";

function connexion($hote=HOTE, $util=UTIL, $mdp=MDP, $nombd=BD_NOM) {
  $cnx = mysqli_connect($hote, $util, $mdp);
  mysqli_select_db($cnx, $nombd);
  mysqli_set_charset($cnx, "utf8");
  return $cnx;
}

function soumettreRequete($cnx, $reqSql) {
  return mysqli_query($cnx, $reqSql);
}

function creer($cnx, $req) {
  $reponse = soumettreRequete($cnx, $req);
  return mysqli_insert_id($cnx);
}

function lire($cnx, $req) {
  $reponse = soumettreRequete($cnx, $req);
  return mysqli_fetch_all($reponse, MYSQLI_ASSOC);
}

function modifier() {

}

function supprimer() {

}


?>