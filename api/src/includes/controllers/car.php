<?php
$kenteken = $routing[1];

if($kenteken) {
    $car = new Car($kenteken);
    $car = $car->fetch($kenteken);

    if($car) {    
        /*
        $data = new Stdclass;*/
        $data->id = $car->id;
        // $data->name = "Kia Picanto";
        $data->type = "car";
        $data->kenteken = $car->kenteken;
        $data->displayKenteken = "7-KSL-16";
        // $data->kenteken = "7KSL16";
        $data->drivers = array();
        $data->drivers[0] = new Stdclass;
        $data->drivers[0]->id = "abcd";
        $data->drivers[0]->name = "Bjorn Schijff";
    }

    die(json_encode($data));
}
?>