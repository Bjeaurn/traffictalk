<?php
$kenteken = $routing[1];

$car = new Car($kenteken);
$car->fetch($kenteken);

/*
$data = new Stdclass;*/
$data->id = uniqid();
// $data->name = "Kia Picanto";
$data->type = "car";
$data->displayKenteken = "7-KSL-16";
// $data->kenteken = "7KSL16";
$data->drivers = array();
$data->drivers[0] = new Stdclass;
$data->drivers[0]->id = "abcd";
$data->drivers[0]->name = "Bjorn Schijff";

die(json_encode($data));
?>