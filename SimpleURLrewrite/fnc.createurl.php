<?php
function createURL($key = '/')
{
    /**
     * Zugriff auf die Sammlung
     **/
    global $meineURLS,$basePath;
    /**
     * prüfen ob der Schlüssel existiert
     **/
    if (empty($basePath)) {
        $basePath = '';
    }
    if (isset($meineURLS[$key])) {
        /**
         * Wenn vorhanden, das rewrite zurückgeben
         **/
        if (isset($meineURLS[$key]['rewrite'])) {
            return $basePath.$meineURLS[$key]['rewrite'];
        }
        return $basePath.$key;
    }
    /**
     * Standardmässig nur den Schlüssel zurückgeben
     * wer will kann bei nicht vorhandenen URL's natürlich
     * auch zb error/404 zurückgeben, aber auf ne Fehlerseite
     * verlinken ist wahrscheinlich sinnfrei
     **/
    return $basePath.$key;
}
