<?php

/**
 * Kontroler zpracuje přijaté data na přihlášení uživatele a ověří, zda jej může přilásit, poté přesměruje uživatele na profil
 */
class PrihlaseniKontroler extends Kontroler
{
    /**
     * Zpracuje poskytnuté údaje
     * 
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        if ($spravceUzivatelu->vratUzivatele())
            $this->presmeruj('profil');
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Přihlášení';
        if ($_POST) {
            try {
                $spravceUzivatelu->prihlas( $_POST['email'], $_POST['heslo']);
                $this->pridejZpravu('Byl jste úspěšně přihlášen.');
                $this->presmeruj('profil');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        // Nastavení šablony
        $this->pohled = 'prihlaseni';
    }
}