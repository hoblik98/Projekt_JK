<?php

/**
 * Kontroler ovlivující profil uživatelů
 */
class ProfilKontroler extends Kontroler
{
    /**
     * Zpracovává údaje, které kontroler získává a předává dál
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        // Do administrace mají přístup jen přihlášení uživatelé
        $this->overUzivatele();
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Profil';
        // Získání dat o přihlášeném uživateli
        $spravceUzivatelu = new SpravceUzivatelu();
        if (!empty($parametry[0]) && $parametry[0] == 'odhlasit') {
            $spravceUzivatelu->odhlas();
            $this->presmeruj('prihlaseni');
        }
        
        //Data do šablony
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        $this->data['jmeno'] = $uzivatel['jmeno'];
        $this->data['prijmeni'] = $uzivatel['prijmeni'];
        $this->data['email'] = $uzivatel['email'];
        $this->data['admin'] = $uzivatel['admin'];

        if (empty($uzivatel['telefon'])) {
            $uzivatel['telefon'] = "Není vyplněno - doplňte!";
        }
        $this->data['telefon'] = $uzivatel['telefon'];

        if (empty($uzivatel['datum_narozeni'])) {
            $uzivatel['datum_narozeni'] = "Není vyplněno. Požádejte administrátora webu o doplnění. :) Možnost editování vlastního profilu je v procesu tvorby. :)";
        }
        $this->data['datum_narozeni'] = $uzivatel['datum_narozeni'];

        // Nastavení šablony
        $this->pohled = 'profil';
    }
}