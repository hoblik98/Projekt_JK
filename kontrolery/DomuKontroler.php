<?php

/**
 * Kontroler vypisující domovskou stránku
 */
class DomuKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array (
            'titulek' => 'Dr. House',
            'klicova_slova' => 'lékař, pacienti, léčitelství',
            'popis' => 'Řešíme náročné zdravotní případy.',
        );
        
        

        //šablona
        $this->pohled = 'domu';

        
    }
}