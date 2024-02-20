<?php

/**
 * Třída poskytuje metody pro správu uživatelů v redakčním systému
 * 
 * registrace
 * zaspisování údajů do databáze
 * přilašování
 * odhlášení
 * ověřování přihlášení
 * získání dat na vypsání uživatele na web
 *
 * 
 * 
 */
class SpravceUzivatelu
{

    
    /**Hashování hesla, aby se ukládalo do databáze přeměněné
     * 
     * @param string $heslo
     * 
     * @return string
     */
    public function vratOtisk(string $heslo): string
    {
        return password_hash($heslo, PASSWORD_DEFAULT);
    }

    /**
     * Registruje nového uživatele do systému a vkládá údaje do databáze
     * 
     *
     * @param string $jmeno 
     * @param string $prijmeni
     * @param string $email
     * @param string $telefon
     * @param string $heslo
     * @param string $hesloZnovu
     * @param string $rok
     * @param int $lekar
     * @param mixed 
     * 
     * @return void
     */
    public function registruj(string $jmeno, string $prijmeni, string $email, string $telefon, string $heslo,  string $hesloZnovu, string $rok, int $lekar, ): void
    {
        if ($rok != date('Y'))
            throw new ChybaUzivatele('Chybně vyplněný antispam.');
        if ($heslo != $hesloZnovu)
            throw new ChybaUzivatele('Hesla nesouhlasí.');
        $uzivatel = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'email' => $email,
            'telefon' => $telefon,
            'heslo' => $this->vratOtisk($heslo),
            'admin' => $lekar,
        );
        try {
            Db::vloz('uzivatele', $uzivatel);
        } catch (PDOException $chyba) {
            throw new ChybaUzivatele('Uživatel s tímto jménem je již zaregistrovaný.');
        }
    }

    
   
    /**Zapíše uživatele, který se reistruje jako pacient automaticky do databáze pacientů
     * 
     * @param string $jmeno
     * @param string $prijmeni
     * @param string $telefon
     * @param string $rodneCislo
     * 
     * @return void
     */
    public function zapisPacientaZUziatelu(string $jmeno, string $prijmeni, string $telefon, string $rodneCislo) : void 
    {
        $pacient = array (
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'rodne_cislo' => $rodneCislo
        );

        Db::vloz('pacienti', $pacient);
        
    }

    /**
     * Přihlásí uživatele do systému
     * ověří existenci uživatele a správnost hesla
     *
     * parametry:
     * @param string $email 
     * @param string $heslo
     * 
     * @return void
     */
    public function prihlas(string $email, string $heslo) : void
    {
        $uzivatel = Db::dotazJeden('
            SELECT uzivatele_id, jmeno, prijmeni, email, admin, telefon, heslo
            FROM uzivatele
            WHERE email = ?
        ', array($email));

        if (!$uzivatel || !password_verify($heslo, $uzivatel['heslo']))
            throw new ChybaUzivatele('Neplatné jméno nebo heslo.');
        $_SESSION['uzivatel'] = $uzivatel;
    
    }

    /**
     * Odhlásí uživatele, který je momentálně přihlášen
     *
     * @return void
     */
    public function odhlas(): void
    {
        unset($_SESSION['uzivatel']);
    }

    /**
     * Vrátí aktuálně přihlášeného uživatele
     * 
     * a jeho hodnoty v databázi
     *
     * @return array|null
     */
    public function vratUzivatele(): ?array
    {
        if (isset($_SESSION['uzivatel']))
            return $_SESSION['uzivatel'];
   
        return null;
    }

    /**
     * Zjistí, zda je uživatel přihlášený
     * 
     * @param bool $prihlaseny
     * @return bool
     */
    public function jePrihlaseny(bool $prihlaseny = true): bool
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        if ($prihlaseny) {
            return $uzivatel !== null;
        } else {
            return $uzivatel == null;
        }
    }

}