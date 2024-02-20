<?php

/**
 * Kontoler zapisující nové pacienty z údajů
 */
class NovyPacientKontroler extends Kontroler
{
    /**
     * Zpracování údajů 
     * 
     * @param array $parametry
     * 
     * @return void
     */
    public function zpracuj(array $parametry): void
    {
        //hlavička stránky
        $this->hlavicka['titulek'] = 'Pacienti Dr. House';
        
        if ($_POST) {
            try {
                $spravcePacientu = new SpravcePacientu();
                //vypočítání věku a daumu narození
                $vek = $spravcePacientu->spocitejVek($_POST['rodne_cislo']);
                $datumNarozeni = $spravcePacientu->spocitejDatumNarozeni($_POST['rodne_cislo']);
                //zapsání pacienta do databáze
                $spravcePacientu->zapisPacienta($_POST['jmeno'], $_POST['prijmeni'], htmlspecialchars($_POST['rodne_cislo']), $datumNarozeni, $_POST['telefonni_cislo'], $vek);
                
                $this->pridejZpravu('Byl jste úspěšně zapsán.');
                $this->presmeruj('pacienti');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        
        
        //nastavení šablony 
        $this->pohled = 'novyPacient';
    }
}



        