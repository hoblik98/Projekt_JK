<?php

/**
 * Kontroler zajiš%tující úspěšnou registraci z údajů od uživatele
 * 
 */
class RegistraceKontroler extends Kontroler
{
    /**
     * Zpracování poskytnutých údajů
     * 
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Registrace';
        
        if ($_POST) {
            try {
                //instance na správu uživatelů - pacienti a lékaři
                $spravceUzivatelu = new SpravceUzivatelu();
                
                
                //když se registruje pacient, tak se automaticky nastaví hodnota lékaře na 0 aby došlo k úspěšné registraci
                if (empty($_POST['lekar'])) {
                    $_POST['lekar'] = 0;
                    //pacient se automaticky i propíše do tabulky pacientů
                    $rodneCislo = "Není zadáno - doplňte!";
                    $spravceUzivatelu->zapisPacientaZUziatelu($_POST['jmeno'], $_POST['prijmeni'], $_POST['telefon'], $rodneCislo);
                }
                

                //regstrace uživatelů do databáze
                $spravceUzivatelu->registruj($_POST['jmeno'],$_POST['prijmeni'], $_POST['email'], $_POST['telefon'],  $_POST['heslo'], $_POST['heslo_znovu'], $_POST['antispam'], $_POST['lekar']);

                //automatické přihlášení nově zaregistrovaného uživatele
                $spravceUzivatelu->prihlas($_POST['email'], $_POST['heslo']);
                $this->pridejZpravu('Byl jste úspěšně zaregistrován.');
                $this->presmeruj('profil');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }

        
        // Nastavení šablony
        $this->pohled = 'registrace';
    }
}