<?php

/**
 * Kontroler umožňující editaci již zapsaných pacientů 
 * změnu jejich údajů
 */
class EditPacientuKontroler extends Kontroler
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
        // ověření zda je užvatel admin - jenom ti mají přístup k editaci
        $this->overUzivatele(true);

        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Editor pacientů';

        // Vytvoření instance modelu
        $spravcePacientu = new SpravcePacientu();

        // Je odeslán formulář na uložení
        if ($_POST) {

            // Získání pacientu z $_POST
            $klice = array('pacienti_id','jmeno', 'prijmeni', 'telefon', 'rodne_cislo');
            $pacient = array_intersect_key($_POST, array_flip($klice));
            $vek = $spravcePacientu->spocitejVek($_POST ['rodne_cislo']);
            $datumNarozeni = $spravcePacientu->spocitejDatumNarozeni($_POST['rodne_cislo']);

            // // Uložení pacienta do DB
            $spravcePacientu->ulozPacienta($_POST['pacienti_id'],  $_POST['jmeno'], $_POST['prijmeni'], $_POST['rodne_cislo'], $datumNarozeni,  $_POST['telefon'], $vek);
            $this->pridejZpravu('Pacient byl úspěšně uložen.');
            $this->presmeruj('pacienti');
        }
        
        // Pacient k editaci
        $nactenyPacient = $spravcePacientu->vratPacienta($parametry[0]);
        $pacient = $nactenyPacient;
       

        //data do šablony
        $this->data['pacient'] = $pacient;
        $this->data['jmeno'] = $pacient['jmeno'];
        $this->data['prijmeni'] = $pacient['prijmeni'];
        //nastavení šablony
        $this->pohled = 'editPacientu';
    }
}