<?php

/**
 * Kontroler, který hlídá chyby a v příadě přesměrovává na chybovou stránku
 */
class ChybaKontroler extends Kontroler
{

    public function zpracuj(array $parametry): void
    {
        // hlavička požadavku
        header ("HTTP/1.0 404 Not Found");
        // ´hlavička stránky
        $this->hlavicka['titulek'] = 'Chyba 404';
        // šablona
        $this->pohled = 'chyba';

    }

    

}