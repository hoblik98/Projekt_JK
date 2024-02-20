<?php

/**
 * Kontroler umožnující editaci článků
 */
class EditorKontroler extends Kontroler
{
    /**
     * Zpracování údajů pomocí kontroleru
     * 
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        // ověření zda je užvatel admin - jenom ti mají přístup k editaci
        $this->overUzivatele(true);
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Editor článků';
        // Vytvoření instance modelu
        $spravceClanku = new SpravceClanku();
        // Příprava prázdného článku
        $clanek = array(
            'clanky_id' => '',
            'titulek' => '',
            'obsah' => '',
            'url' => '',
            'popisek' => '',
            'klicova_slova' => '',
        );
        // Je odeslán formulář
        if ($_POST) {
            // Získání článku z $_POST
            $klice = array('titulek', 'obsah', 'url', 'popisek', 'klicova_slova');
            $clanek = array_intersect_key($_POST, array_flip($klice));
            // Uložení článku do DB
            $spravceClanku->ulozClanek($_POST['clanky_id'], $clanek);
            $this->pridejZpravu('Článek byl úspěšně uložen.');
            $this->presmeruj('clanek/' . $clanek['url']);
        } else if (!empty($parametry[0])) {
            // Je zadané URL článku k editaci
            $nactenyClanek = $spravceClanku->vratClanek($parametry[0]);
            if ($nactenyClanek)
                $clanek = $nactenyClanek;
            else
                $this->pridejZpravu('Článek nebyl nalezen');
        }

        $this->data['clanek'] = $clanek;
        $this->pohled = 'editor';
    }
}