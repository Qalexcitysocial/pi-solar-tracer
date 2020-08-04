<?php
header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=solardata;host=127.0.0.1","root","password");

switch($_GET['q']){
    // Buscar Último Datos de Panel photovoltaic
    case 1:
        $statement=$pdo->prepare("SELECT `timestamp`,`PV_array_voltage`,`PV_array_current`,`PV_array_power` FROM `status` WHERE timestamp >= NOW() - INTERVAL 1 DAY");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);

        $json=json_encode($results, JSON_NUMERIC_CHECK);
        echo $json;
        break;

    // Buscar datos battery
    case 2:
        $statement=$pdo->prepare("SELECT `timestamp`,`Battery_voltage`,`Battery_charging_current`,`Battery_charging_power` FROM `status` WHERE timestamp >= NOW() - INTERVAL 1 DAY");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);

        $json=json_encode($results, JSON_NUMERIC_CHECK);
        echo $json;
        break;

    // Buscar datos load DC
    case 3:
        $statement=$pdo->prepare("SELECT `timestamp`,`Load_voltage`,`Load_current`,`Load_power` FROM `status` WHERE timestamp >= NOW() - INTERVAL 1 DAY");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);

        $json=json_encode($results, JSON_NUMERIC_CHECK);
        echo $json;
        break;
}

?>


