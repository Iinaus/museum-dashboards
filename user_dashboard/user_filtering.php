<?php
session_start();

// haetaan museon filtteri
$mid = $_SESSION['username'];

// haetaan päivämääräfilterin arvot
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

// jos aloituspäivää ei ole valittu, haetaan data 2000-luvun alusta alkaen
if (!isset($start_date) or $start_date == '') {
    $start_date = '2000-01-01';
}

// jos lopetuspäivää ei ole valittu, haetaan data tähän päivään asti
if (!isset($end_date) or $end_date == '') {
    $end_date = date('Y-m-d');
}

// muokataan arvot SQL tarvitsemaan muotoon

$start_date_formatted = date('Y-m-d', strtotime($start_date));
$end_date_formatted = date('Y-m-d', strtotime($end_date));

// Aloituspäivä ei voi olla ennen lopetuspäivää
if ($start_date_formatted > $end_date_formatted) {
    die('Invalid date range.');
}
?>