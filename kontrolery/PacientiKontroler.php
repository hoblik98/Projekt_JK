<?php

class PacientiKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        //hlavička stránky
        $this->hlavicka['titulek'] = 'Pacienti Dr. House';

        // Vytvoření instance modelu, který nám umožní pracovat s články
        $spravcePacientu = new SpravcePacientu();

        // Získání článku podle URL
        $pacienti = $spravcePacientu->vratPacienty();
        // Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
        if (!$pacienti)
            $this->presmeruj('chyba');


        // Nastavení šablony
        $this->pohled = 'pacienti';
    
    }
}


        