<?php

/**
 *  CRUD wrapper pro komunikaci s databází
 */
class Db
{
    private static PDO $spojeni;
    private static array $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    /**Připojení k databázi
     * 
     * @param string $host dostitel databaze
     * @param string $uzivatel jméno
     * @param string $heslo heslo
     * @param string $databaze název databáze
     * 
     * @return void
     */
    public static function pripoj(string $host, string $uzivatel, string $heslo, string $databaze) : void 
    {
        if (!isset(self::$spojeni)) {
            self::$spojeni = @new PDO(
                "mysql:host=$host;dbname=$databaze",
                $uzivatel,
                $heslo,
                self::$nastaveni
            );
        }
        
    }

    /**
     * Spustí dotaz a vrátí z něj první řádek
     * 
     * @param string $dotaz SQL dotaz s parametry nahrazenými otazníky
     * @param array $parametry Parametry pro doplnění do připraveného SQL dotazu
     * @return array|bool Asociativní pole s informacemi z prvního řádku výsledku nebo FALSE v případě prázdného výsledku
     */
    public static function dotazJeden(string $dotaz, array $parametry = array()): array|bool
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }

    /**
     * Spustí dotaz a vrátí všechny jeho řádky
     * @param string $dotaz SQL dotaz s parametry nahrazenými otazníky
     * @param array $parametry Parametry pro doplnění do připraveného SQL dotazu
     * @return array|bool Pole asociativních pole s informacemi o všech řádcích výsledku nebo FALSE v případě prázdného výsledku
     */
    public static function dotazVsechny(string $dotaz, array $parametry = array()): array|bool
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll();
    }

    /**
     * Spustí dotaz a vrátí z něj první sloupec prvního řádku
     * @param string $dotaz SQL dotaz s parametry nahrazenými otazníky
     * @param array $parametry Parametry pro doplnění do připraveného SQL dotazu
     * @return string|null Hodnota v prvním sloupci prvního řádku výsledku
     */
    public static function dotazSamotny(string $dotaz, array $parametry = array()): string
    {
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek[0];
    }

    
    /**
     * Spustí dotaz a vrátí počet ovlivněných řádků
     * @param string $dotaz SQL dotaz s parametry nahrazenými otazníky
     * @param array $parametry Parametry pro doplnění do připraveného SQL dotazu
     * @return int Počet ovlivněných řádků
     */
    public static function dotaz(string $dotaz, array $parametry = array()): int
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }

    /**
     * Vloží do tabulky nový řádek jako data z asociativního pole
     * @param string $tabulka Název databázové tabulky
     * @param array $parametry Asociativní pole parametrů pro vložení
     * @return bool TRUE v případě úspěšného provedení dotazu
     */
    public static function vloz(string $tabulka, array $parametry = array()): bool
    {
        return self::dotaz("INSERT INTO `$tabulka` (`".
            implode('`, `', array_keys($parametry)).
            "`) VALUES (".str_repeat('?,', sizeOf($parametry)-1)."?)",
                array_values($parametry));
    }

    /**
     * Změní řádek v tabulce tak, aby obsahoval data z asociativního pole
     * @param string $tabulka Název databázové tabulky
     * @param array $hodnoty Asociativní pole hodnot ke změně
     * @param string $podminka Podmínka pro ovlivňované záznamy ("WHERE ...")
     * @param array $parametry Asociativní pole dalších parametrů
     * @return bool TRUE v případě úspěšného provedení dotazu
     */
    public static function zmen(string $tabulka, array $hodnoty, string $podminka, array $parametry = array()): bool
    {
        return self::dotaz("UPDATE `$tabulka` SET `".
            implode('` = ?, `', array_keys($hodnoty)).
            "` = ? " . $podminka,
            array_merge(array_values($hodnoty), $parametry));
    }
    
    /**
     * Vrací ID posledně vloženého záznamu
     * @return int ID posledního vloženého záznamut
     */
    public static function posledniId(): int
    {
        return self::$spojeni->lastInsertId();
    }
}