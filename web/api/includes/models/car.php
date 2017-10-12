<?php
class Car {

    function __construct(string $kenteken) {}

    public function fetch(string $kenteken): Car {
        $this->fetchFromDatabase($kenteken);
        if(!$this->id) {
            $car = $this->fetchRemote($kenteken);
            if(!$car->isEmpty()) {
                $this->persistData($car);
                $obj = new Car($car->kenteken);
                $obj->id = $car->id;
                $obj->data = json_encode($car);
                $this->fill($obj);
            }
        }
        return $this;
    }

    function isEmpty(): bool {
        return false;
    }

    private function fill($obj): Car {
        $this->data = json_decode($obj->data);
        $this->kenteken = $obj->kenteken;
        $this->id = $obj->id;
        return $this;
    }

    private function fetchFromDatabase(string $kenteken): Car {
        $db = Database::start();
        $kenteken = strtoupper($kenteken);
        $result = $db->query("SELECT * FROM cars WHERE kenteken = '". $kenteken ."'");
        if($db->num_rows($result)>0) {
            // $this-> assignment verstoppen in een fill();
            $row = $db->fetch($result);
            $this->fill($row);
            return $this;
        }
        return new EmptyCar();
    }

    private function persistData(Car $car) {
        $db = Database::start();
        $result = $db->query("INSERT INTO cars (kenteken, data) VALUES ('". $car->kenteken ."', '".json_encode($car)."')");
    }

    private function fetchRemote(string $kenteken): Car {
        $kenteken = strtoupper($kenteken);
        $url = 'https://opendata.rdw.nl/resource/m9d7-ebf2.json?$$app_token=siAJatNuW8SLBtzE04JSkFmWs&kenteken='.$kenteken;
        // $url = str_replace("&amp;", '&', $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);
        $resObj = $response[0];
        if($resObj->kenteken !== null) {
            $data = new Car($resObj->kenteken);
            $data->id = uniqid();
            $data->merk = $resObj->merk;
            $data->naam = $resObj->handelsbenaming;
            $data->kenteken = $resObj->kenteken;
            $data->kleur = $resObj->eerste_kleur;
        } else {
            $data = new EmptyCar();
        }
        return $data;
    }

}

class EmptyCar extends Car {
    function __construct() {}

    function isEmpty(): bool {
        return true;
    }
}
?>