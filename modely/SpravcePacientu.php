<?php

class SpravcePacientu 
{
    /**
     * Zapíše nového pacienta do databáze
     */
    public function zapisPacienta(string $jmeno, string $prijmeni, string $datum_narozeni, string $telefonni_cislo): void
    {
        $pacient = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'vek' => $datum_narozeni,
            'telefon' => $telefonni_cislo
        );
        try {
            Db::vloz('pacienti', $pacient);
        } catch (PDOException $chyba) {
            throw new ChybaUzivatele('Pacient s tímto jménem je již zaregistrovaný.');
        }
    }

    /**
     * Vrátí seznam pacientů v databázi
     */
    public function vratPacienty(): array
    {
        return Db::dotazVsechny('
            SELECT `pacienti_id`, `jmeno`, `prijmeni`, `vek`, `telefon`
            FROM `pacienti`
            ORDER BY `pacienti_id` DESC
        ');
    }


}