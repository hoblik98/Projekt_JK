<?php

class DomuKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array (
            'titulek' => 'Pacienti Dr. House',
            'klicova_slova' => 'lékař, pacienti, léčitelství',
            'popis' => 'Řešíme náročné zdravotní případy.',
        );
        $this->pohled = 'domu';
    }
}