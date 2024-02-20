<?php


/**
 * Třída poskytuje metody pro správu článků v redakčním systému
 * 
 * zapisování článku do databáze
 * získání dat na vypsání článků 
 * 
 */
class SpravceClanku
{

    
    /**Vrátí článek z databáze podle jeho URL
     * 
     * @param string $url parametr indikující určitý článek
     * 
     * @return array Vrátí se hodnoty z databáze
     */
    public function vratClanek(string $url): array
    {
        return Db::dotazJeden('
            SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
            FROM `clanky`
            WHERE `url` = ?
        ', array($url));
    }

    
    /**Vrátí seznam včech článků v databázi seřezené podle ID sestupně
     * 
     * @return array 
     */
    public function vratClanky(): array
    {
        return Db::dotazVsechny('
            SELECT `clanky_id`, `titulek`, `url`, `popisek`
            FROM `clanky`
            ORDER BY `clanky_id` DESC
        ');
    }

    /**Uloží článek buď už existující neb vytvoří nový záznam do databáze
     * Db:vloz - vytvoří nový záznam
     * Db:zmen - změní záznam
     * 
     * @param int|bool $id
     * @param array $clanek
     * 
     * @return void
     */
    public function ulozClanek(int|bool $id, array $clanek) : void 
    {
        if (!$id)
            Db::vloz('clanky', $clanek);
        else
            Db::zmen('clanky', $clanek, 'WHERE clanky_id = ?', array($id));
    }

    /**Odstraní záznam z databáze
     * 
     * @param string $url
     * 
     * @return void
     */
    public function odstranClanek(string $url) : void 
    {
        Db::dotaz('
            DELETE FROM clanky
            WHERE url = ?
            ', array($url));
    }

}