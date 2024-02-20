<?php

/**
 * Kontroler zpraující pacienty, jejich vypsání a přijímání dat
 */
class PacientiKontroler extends Kontroler
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
        //hlavička stránky
        $this->hlavicka['titulek'] = 'Pacienti Dr. House';

        // Vytvoření instance modelu, který nám umožní pracovat s články
        $spravcePacientu = new SpravcePacientu();
        $spravceUzivatelu = new SpravceUzivatelu();
        //ověření uživatele
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        $this->data['admin'] = $uzivatel && $uzivatel['admin'];

        // Smazání pacientů z výspisu
        if (!empty($parametry[1]) && $parametry[1] == 'odstranit') {
            $this->overUzivatele(true);
            $spravcePacientu->odstranPacienta($parametry[0]);
            $this->pridejZpravu('Pacient byl úspěšně odstraněn');
            $this->presmeruj('pacienti');
        }
        

        // Vypsání všech pacientu v databázi
        $pacienti = $spravcePacientu->vratPacienty();
        
        // promněnné do šablony
        $this->data['pacienti'] = $pacienti;
    
        

        // Nastavení šablony
        $this->pohled = 'pacienti';
    
    }

}


