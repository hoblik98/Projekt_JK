<?php

/**
 * Kontroler zpracující kontatový formulář webu
 */
class KontaktKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array (
            'titulek' => 'Kontaktni formulář',
            'klicova_slova' => 'kontakt, email, formulář',
            'popis' => 'Kontaktní fomulář našeho webu.',
        );
        
        if ($_POST) {
            try {
                $odesilacEmailu = new OdesilacEmailu();
                $odesilacEmailu->odesliSAntispamem($_POST['rok'], "admin@adresa.cz", "Email z webu", $_POST['zprava'], $_POST['email']);
                $this->pridejZpravu('Email byl úspěšně odeslán.');
                $this->presmeruj('kontakt');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        $this->pohled = 'kontakt';
    }
}