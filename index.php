<?php
// zapnutí session
session_start();
// kodování
mb_internal_encoding("UTF-8");


// automatické propojování tříd
function autoloadFunkce (string $trida) : void
{
    if (preg_match('/Kontroler$/', $trida))
        require ("kontrolery/" . $trida . ".php");
    else
        require ("modely/" . $trida . ".php");
}

spl_autoload_register("autoloadFunkce");

// připojení k databázi
Db::pripoj("localhost", "root", "", "mvc_db");

// instance smerovace
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));

$smerovac->vypisPohled();