<?php
function __autoload($className) {
    require_once 'classes/'.$className.'.php';
}

/*inits a db connection */
$connection = new DBConnection;
$connection = $connection->init('localhost', 'root', 'root', 'aratu_completo');
$weather = new Weather();



$sql = "SELECT * FROM `city_weather` ORDER BY updated_at ASC LIMIT 1";
$query = $connection->prepare($sql);
$query->setFetchMode(PDO::FETCH_OBJ);
$query->execute();
while($row = $query->fetch()) {

    $info = $weather->getWeatherForCity($row->search_for);
    $observationDate = date('Y-m-d H:i:s', strtotime($info->observationTime.' -1 hours'));

    $sql = "UPDATE `city_weather` SET `updated_at` = NOW(), temp_min = {$info->tempMin}, temp_max = {$info->tempMax}, icon_name = '{$info->iconName}', observation_date = '{$observationDate}', current_temp = {$info->currentTemp}  WHERE city_slug = '{$row->city_slug}'";
    $update = $connection->prepare($sql)->execute();

}