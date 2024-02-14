<?php

abstract class Kontroler
{
    protected array $data = array ();
    protected string $pohled = "";
    protected array $hlavicka = array ('titulek' => '', 'klicova_slova' => '', 'popis' => '');

    abstract function zpracuj(array $parametry) : void;

    public function vypisPohled() : void 
    {
        if ($this->pohled){
            extract ($this->osetri($this->data));
            #když nechci vpisovat dta ošetřená prosí útoku XSS tak napíšu před proměnnou _ př. $_promenna vs $promenna;
            extract($this->data, EXTR_PREFIX_ALL, ""); 
            require ("pohledy/" . $this->pohled . ".phtml");
        }
        
    }
    
    public function presmeruj(string $url) : never 
    {
        header ("Location: /$url");
        header ("Connection: close");
        exit;
        
    }

    // ošetření proti útoku XSS - utomatické projetí proměnných htmlspecilchars funkcí
    private function osetri(mixed $x = null) : mixed 
    {
        if(!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif(is_array($x)){
            foreach ($x as $k => $v) {
                $x[$k] = $this->osetri($v);
            }
            return $x;
        } else
            return $x;
    }

    // vypisování zpráv pro uživatele
    public function pridejZpravu(string $zprava) : void 
    {
        if(isset($_SESSION['zpravy']))
            $_SESSION['zpravy'][] = $zprava;
        else
            $_SESSION['zpravy'] = array($zprava);
        
    }

    public function vratZpravy() : array 
    {
        if(isset($_SESSION['zpravy'])) {
            $zpravy = $_SESSION['zpravy'];
            unset($_SESSION['zpravy']);
            return $zpravy;
        } else
            return array();
        
    }

    public function overUzivatele(bool $admin = false): void
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        $uzivatel = $spravceUzivatelu->vratUzivatele();
        if (!$uzivatel || ($admin && !$uzivatel['admin'])) {
            $this->pridejZpravu('Nedostatečná oprávnění.');
            $this->presmeruj('prihlaseni');
        }
    }


}