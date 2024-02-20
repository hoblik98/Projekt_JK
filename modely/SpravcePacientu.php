<?php

/**
 * Třída poskytuje metody pro správu pacientů v redakčním systému
 * 
 * zapsání pacienta do databáze
 * získávání dat o pacientech
 * změna údaju a mazání 
 * počítání věku a datumu narození
 * 
 */
class SpravcePacientu 
{
    /**
     * Zapíše nového pacienta a s parametry uloží do databáze
     **
     * @param string $jmeno  pacienta
     * @param string $prijmeni  pacienta
     * @param string $rodneCislo pacienta
     * @param string $datumNarozeni pacienta
     * @param string $telefonniCislo pacienta
     * @param string $vek pacienta
     * 
     * @return void
     */
    public function zapisPacienta(string $jmeno, string $prijmeni, string $rodneCislo, string $datumNarozeni, string $telefonniCislo, string $vek): void
    { 

        $pacient = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'rodne_cislo' => $rodneCislo,
            'datum_narozeni' => $datumNarozeni,
            'telefon' => $telefonniCislo,
            'vek' => $vek
        );
        try {
            Db::vloz('pacienti', $pacient);
        } catch (PDOException $chyba) {
            throw new ChybaUzivatele('Pacient s tímto rodným číslem je již zaregistrovaný.');
        }
    }

    /**
     * Vrátí seznam pacientů v databázi a hodnoty
     * seřezené sestupně
     *
     * @return array
     */
    public function vratPacienty(): array
    {
        return Db::dotazVsechny('
            SELECT `pacienti_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `telefon`, `vek`, `rodne_cislo`
            FROM `pacienti`
            ORDER BY `pacienti_id` DESC
        ');
    }

  
    /**Vrátí pacienta z databáze podle jeho id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function vratPacienta(int $id): array
    {
        return Db::dotazJeden('
            SELECT `pacienti_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `telefon`, `vek`, `rodne_cislo`
            FROM `pacienti`
            WHERE `pacienti_id` = ?
        ', array($id));
    }



    /** Automatické vypočítání věku z rodného čísla
     * 
     * @param string $rodneCislo
     * 
     * @return int vrátí se věk ve formátu př. 1965
     */
    public function spocitejVek(string $rodneCislo) : int
    {
            $rok = substr($rodneCislo,0,2); //Získání roku z rodného čísla
            if ($rok > date('Y') - 2000)
                    $rok = '19'.$rok; //Osoby před rokem 2000
            else
                    $rok = '20'.$rok; //Osoby po roce 2000

            $mesic = (int)substr($rodneCislo,2,2); //Získání měsíce z rodného čísla
            if ($mesic >= 50)
                    $mesic = $mesic - 50;  //Odečíst číslo 50 u žen

            if ($mesic >= 20)
                    $mesic = $mesic - 20; //Odečíst číslo 20 u alternativních rodných čísel (když daný den dojdou normální)

            $den = (int)substr($rodneCislo,4,2); //Získání dne z rodného čísla

            $datumNarozeni = mktime(0,0,0,$mesic,$den,$rok); //Uložení data narození do proměné

            $aktualniDatum = time(); //Získání aktualního data
            $vekTimestamp = $aktualniDatum - $datumNarozeni; //Výpočet věku

            $vek = date('Y',$vekTimestamp); //Získání počtu let z timestamp
            $vek = $vek - 1970; //Odečteme 1970 kvůli tomu, že timestamp se počítá od roku 1970

            return $vek;
    }

    /** Automatické vypočítání datumu narození z rodného čísla
     * 
     * @param string $rodneCislo
     * 
     * @return string vrátí se datum jako string ve formátu den. měsíc. rok
     */
    public function spocitejDatumNarozeni(string $rodneCislo) : string
    {
            $rok = substr($rodneCislo,0,2); //Získání roku z rodného čísla
            if ($rok > date('Y') - 2000)
                    $rok = '19'.$rok; //Osoby před rokem 2000
            else
                    $rok = '20'.$rok; //Osoby po roce 2000

            $mesic = (int)substr($rodneCislo,2,2); //Získání měsíce z rodného čísla
            if ($mesic >= 50)
                    $mesic = $mesic - 50;  //Odečíst číslo 50 u žen

            if ($mesic >= 20)
                    $mesic = $mesic - 20; //Odečíst číslo 20 u alternativních rodných čísel (když daný den dojdou normální)

            $den = (int)substr($rodneCislo,4,2); //Získání dne z rodného čísla

            $datumNarozeniTimestamp = mktime(0,0,0,$mesic,$den,$rok); //Uložení data narození do proměné v sekundách od 1970
            
            $datumNarozeni = date('j. m. Y', $datumNarozeniTimestamp); //převod vteřin na datum pohle zadání

            return $datumNarozeni;
        
    }
    

    /**Uloží změněné údaje o pacientovi do databáze
     * 
     * změněné údaje v parametrech:
     * @param int|bool $id
     * @param string $jmeno
     * @param string $prijmeni
     * @param string $rodneCislo
     * @param string $datumNarozeni
     * @param string $telefonniCislo
     * @param string $vek
     * 
     * @return void
     */
    public function ulozPacienta(int|bool $id, string $jmeno, string $prijmeni, string $rodneCislo, string $datumNarozeni, string $telefonniCislo, string $vek) : void 
    {
        $pacient = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'rodne_cislo' => $rodneCislo,
            'datum_narozeni' => $datumNarozeni,
            'telefon' => $telefonniCislo,
            'vek' => $vek
        );


        if ($id)
            Db::zmen('pacienti', $pacient, 'WHERE pacienti_id = ?', array($id));
    }

    

    /**Odstraní pacienta z databáze a jeho záznamy
     * 
     * @param int $pacienti_id
     * 
     * @return void
     */
    public function odstranPacienta(int $pacienti_id) : void 
    {
        Db::dotaz('
            DELETE FROM pacienti
            WHERE pacienti_id = ?
            ', array($pacienti_id));
    }

        
    




}

