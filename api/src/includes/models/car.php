<?php
class Car {

    function __construct(string $kenteken) {}

    public function fetch(string $kenteken): Car {
        $this->fetchFromDatabase($kenteken);
        if(!$this->id) {
            $car = $this->fetchRemote($kenteken);
            $this->persistData($car);
            $this->kenteken = $car->kenteken;
        }
        return $this;
    }

    function isEmpty(): bool {
        return false;
    }

    private function fetchFromDatabase(string $kenteken): Car {
        $db = Database::start();
        $kenteken = strtoupper($kenteken);
        $result = $db->query("SELECT * FROM cars WHERE kenteken = '". $kenteken ."'");
        if($db->num_rows($result)>0) {
            // $this-> assignment verstoppen in een fill();
            $row = $db->fetch($result);
            $this->kenteken = $row->kenteken;
            $this->id = $row->id;
            return $this;
        }
        return new EmptyCar();

    }

    private function persistData(Car $car) {
        $db = Database::start();
        $result = $db->query("INSERT INTO cars (id, kenteken) VALUES ('". uniqid() ."', '". $car->kenteken ."')");
    }

    private function fetchRemote(string $kenteken) {
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

        $data = new Car($resObj->kenteken);
        $data->id = uniqid();
        $data->merk = $resObj->merk;
        $data->naam = $resObj->handelsbenaming;
        $data->kenteken = $resObj->kenteken;
        $data->kleur = $resObj->eerste_kleur;
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