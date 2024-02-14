<?php

class NovyPacientKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        //hlavička stránky
        $this->hlavicka['titulek'] = 'Pacienti Dr. House';
        
        if ($_POST) {
            try {
                $spravcePacientu = new SpravcePacientu();
                $spravcePacientu->zapisPacienta($_POST['jmeno'], $_POST['prijmeni'], $_POST['datum_narozeni'], $_POST['telefonni_cislo']);
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



        