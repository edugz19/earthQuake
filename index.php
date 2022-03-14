<?php
header('Access-Control-Allow-Origin: *');
$data = simplexml_load_file("http://www.ign.es/ign/RssTools/sismologia.xml");
$namespaces = $data->getNamespaces(true);

$array = [];

foreach ($data->channel->item as $item) {
    $description = [
        'time' => substr((string)$item->title, 28,),
        'date' => substr((string)$item->title, 17, 10),
        'link' => (string)$item->link,
        'description' => (string)$item->description,
        'lat' => (string) $item->children($namespaces['geo'])->lat,
        'long' => (string) $item->children($namespaces['geo'])->long

    ];
    array_push($array, $description);
}

echo json_encode($array);
