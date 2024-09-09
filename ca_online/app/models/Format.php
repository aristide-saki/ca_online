<?php

class Format
{
}

function numberFormat($number)
{
    if ($number == 0) {
        $result = 0;
    } else {
        $result = number_format($number, 0, '', ' ');
    }
    return $result;
}

function dateFormat($date)
{
    return date('d/m/Y', strtotime($date));
}
function heureFormat($date)
{
    return date('H:i:s', strtotime($date));
}

function livraisonStatus($status)
{
    switch ($status) {
        case 'en attente':
            $reponse = '<span class="status_pending">En attente</span>';
            break;
        case 'annulée':
            $reponse = '<span class="status_danger">Annulée</span>';
            break;
        case 'livrée':
            $reponse = '<span class="status_success">Livrée</span>';
            break;
        case 'reportée':
            $reponse = '<span class="status_schedule">Reportée</span>';
            break;
        default:
            $reponse = '';
            break;
    }
    return $reponse;
}


function slugify($text)
{
    // Convertir les caractères spéciaux en leurbéquivalent non accentué
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

    // Supprimer les tirets multiples
    $text = preg_replace('/-+/', '-', $text);

    // Supprimer les espaces par des tirets
    $text = str_replace(' ', '-', $text);

    // Remplacer les caractères non alphanumériques par des birets
    $text = preg_replace('[^a-zA-Z0-9]', '-', $text);

    // Supprimer les tirets en debuts et à la fin
    $text = trim($text, '-');

    // convertir en minuscule
    $text = strtolower($text);

    return $text;
}


function getSocialImage($socialName)
{
    $socials = [
        'Facebook' => 'facebook-logo.webp',
        'Twitter' => 'twitter-new.avif',
        'Instagram' => 'instagram-logo.jpg',
        'LinkedIn' => 'LinkedIn_logo_initials.png',
        'Whatsapp' => 'whatsapp-logo.webp',
    ];

    return $socials[$socialName] ?? null;
}

function getLastSegmentOfUrl()
{
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $lastPart = end($parts);
    return $lastPart;
}

function getUrlPart($i)
{
    $url = $_SERVER['REQUEST_URI'];
    $replace = str_replace(BASE_URL, '', $url);
    $parts = explode('/', $replace);


    // Vérifier si l'index $i existe dans le tableau $parts
    if (isset($parts[$i])) {
        $part = $parts[$i];
        return $part;
    } else {
        return false; // Retourner false si l'index $i n'existe pas
    }
}