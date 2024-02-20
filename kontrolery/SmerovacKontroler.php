<?php

/**
 * Kontroler, který podle URL zjistí příslušný kontroler, zavolá ho a uloží do atributu $kontroler
 * Uloží do své šablony (rozložení stránky) pohled volaného kontroleru (obsah stránky) a zobrazí výsledek uživateli 
 */
class SmerovacKontroler extends Kontroler
{
    protected Kontroler $kontroler;

    /**
     * Zpracování údajů pomocí kontoleru
     * 
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        $naparsovanaURL = $this->parsujURL($parametry[0]);

        if(empty($naparsovanaURL[0]))
            $this->presmeruj('domu');
        $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';

        if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
            $this->kontroler = new $tridaKontroleru;
        else
            $this->presmeruj('chyba');

        $this->kontroler->zpracuj($naparsovanaURL);

        $this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
        $this->data['popis'] = $this->kontroler->hlavicka['popis'];
        $this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];

        // Proměnné pro šablonu
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        $this->data['uzivatel'] = $spravceUzivatelu->jePrihlaseny();
    

        // nastavení hlavní šablony
        $this->pohled = 'rozlozeni';

        // vypisování zpráv uživateli
        $this->data['zpravy'] = $this->vratZpravy();
        
    }

     /**
     * Převede název kontroleru s pomlčkami (kebab case) na název třídy (camelCase)
     * 
     * @param string $text kebab case
     * 
     * @return string
     */
    private function pomlckyDoVelbloudiNotace(string $text) : string 
    {
        $veta = str_replace('-', ' ', $text);
        $veta = ucwords($veta);
        $veta = str_replace(' ', '', $veta);
        return $veta;
        
    }

    /**
     * Naparsuje URL adresu a vrátí ji ve formě pole parametrů
     * 
     * @param string $url
     * 
     * @return array
     */
    private function parsujURL(string $url) : array 
    {
        $naparsovanaURL = parse_url($url);
        $naparsovanaURL['path'] = ltrim($naparsovanaURL['path'], "/");
        $naparsovanaURL['path'] = trim($naparsovanaURL['path']);
        $rozdelenaCesta = explode("/", $naparsovanaURL['path']);
        return $rozdelenaCesta;
        
    }

   
}