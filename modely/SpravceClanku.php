<?php

/**
 * Třída poskytuje metody pro správu článků v redakčním systému
 */
class SpravceClanku
{

    /**
     * Vrátí článek z databáze podle jeho URL
     */
    public function vratClanek(string $url): array
    {
        return Db::dotazJeden('
            SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
            FROM `clanky`
            WHERE `url` = ?
        ', array($url));
    }

    /**
     * Vrátí seznam článků v databázi
     */
    public function vratClanky(): array
    {
        return Db::dotazVsechny('
            SELECT `clanky_id`, `titulek`, `url`, `popisek`
            FROM `clanky`
            ORDER BY `clanky_id` DESC
        ');
    }

    public function ulozClanek(int|bool $id, array $clanek) : void 
    {
        if (!$id)
            Db::vloz('clanky', $clanek);
        else
            Db::zmen('clanky', $clanek, 'WHERE clanky_id = ?', array($id));
    }

    public function odstranClanek(string $url) : void 
    {
        Db::dotaz('
            DELETE FROM clanky
            WHERE url = ?
            ', array($url));
    }

}