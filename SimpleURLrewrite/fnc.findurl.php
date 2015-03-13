<?php

function findURL()
{
    /**
     * Zugriff auf die Sammlung
     **/
    global $meineURLS,$basePath;

    if (empty($basePath)) {
        $basePath = '';
    }

    $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    $requestUrl = substr($requestUrl, strlen($basePath));

    $returnData = false;
    foreach ($meineURLS as $URLKey => $urlData) {
        if (isset($urlData['rewrite']) && strtolower($urlData['rewrite']) == strtolower($requestUrl)) {
            $returnData = $urlData;
            $returnData['key'] = $URLKey;
            break;
        } elseif (strtolower($URLKey) == strtolower($requestUrl)) {
            $returnData = $urlData;
            $returnData['key'] = $URLKey;
            break;
        }
    }
    return $returnData;

}
