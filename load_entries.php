<?php
include 'db.php';
$year = intval($_GET['year']);
$week = intval($_GET['week']);

$result = $conn->query("SELECT * FROM entries WHERE year=$year AND week=$week");
$entries = [];
while($row = $result->fetch_assoc()){
    $key = "{$row['year']}-W".str_pad($row['week'],2,'0').":{$row['day']}:{$row['period']}";
    $entries[$key] = [
        'good'=>$row['good'],
        'bad'=>$row['bad'],
        'comment'=>$row['comment'],
        'mood'=>intval($row['mood']),
        'color'=>$row['color']
    ];
    if($row['disabled']){
        $entries['disabled'][$row['day']] = true;
    }
}
echo json_encode(['entries'=>$entries]);
?>
