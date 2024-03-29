<?php

class ClanekKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
            // Vytvoření instance modelu, který nám umožní pracovat s články
        $spravceClanku = new SpravceClanku();
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        $this->data['admin'] = $uzivatel && $uzivatel['admin'];

        // Je zadáno URL článku ke smazání
         if (!empty($parametry[0])) {
            // Je zadáno URL článku
            // Získání článku podle URL
            $clanek = $spravceClanku->vratClanek($parametry[0]);
                // Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
            if (!$clanek)
                $this->presmeruj('chyba');

            // Hlavička stránky
            $this->hlavicka = array(
                'titulek' => $clanek['titulek'],
                'klicova_slova' => $clanek['klicova_slova'],
                'popis' => $clanek['popisek'],
            );

            // Naplnění proměnných pro šablonu
            $this->data['titulek'] = $clanek['titulek'];
            $this->data['obsah'] = $clanek['obsah'];

            // Nastavení šablony
            $this->pohled = 'clanek';
        
        }
    }
}