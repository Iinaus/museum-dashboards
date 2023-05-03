<?php
session_start();

// haetaan päivämääräfilterin arvot
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

// jos aloituspäivää ei ole valittu, haetaan data 2000-luvun alusta alkaen
if (!isset($start_date) OR $start_date == '') {
    $start_date = '2000-01-01';
}

// jos lopetuspäivää ei ole valittu, haetaan data tähän päivään asti
if (!isset($end_date) OR $end_date == '') {
    $end_date = date('Y-m-d');
}

// muokataan arvot SQL tarvitsemaan muotoon

$start_date_formatted = date('Y-m-d', strtotime($start_date));
$end_date_formatted = date('Y-m-d', strtotime($end_date));

// Aloituspäivä ei voi olla ennen lopetuspäivää
if ($start_date_formatted > $end_date_formatted) {
    die('Invalid date range.');
}

// haetaan museo ID filtterin arvot
$filter_mid1 = $_SESSION['mid1'];
$filter_mid2 = $_SESSION['mid2'];
$filter_mid3 = $_SESSION['mid3'];
$filter_mid4 = $_SESSION['mid4'];

// jos museota ei ole valittu tai sessio antaa väärän arvon, muutetaan arvo tyhjäksi

if (isset($filter_mid1) AND $filter_mid1 == 'mid1') {
    $filter_mid1 = 'mid1';
} else {
    $filter_mid1 = '';
}

if (isset($filter_mid2) AND $filter_mid2 == 'mid2') {
    $filter_mid2 = 'mid2';
} else {
    $filter_mid2 = '';
}

if (isset($filter_mid3) AND $filter_mid3 == 'mid3') {
    $filter_mid3 = 'mid3';
} else {
    $filter_mid3 = '';
}

if (isset($filter_mid4) AND $filter_mid4 == 'mid4') {
    $filter_mid4 = 'mid4';
} else {
    $filter_mid4 = '';
}

// määritellään oletusarvo, jolla haetaan kaikkien museoiden tiedot, jos yhtään museota ei ole valittu

if ($filter_mid1 == '' AND $filter_mid2 == '' AND $filter_mid3 == '' AND $filter_mid4 == '') {
    $filter_default = 'mid%';
} else {
    $filter_default = '';
}
?>