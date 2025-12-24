<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$stmt = $conn->prepare("
    INSERT INTO entries (year, week, day, period, good, bad, comment, mood, color, disabled)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE good=VALUES(good), bad=VALUES(bad), comment=VALUES(comment),
                            mood=VALUES(mood), color=VALUES(color), disabled=VALUES(disabled)
");
$stmt->bind_param(
    "iiiisssiis",
    $data['year'],
    $data['week'],
    $data['day'],
    $data['period'],
    $data['good'],
    $data['bad'],
    $data['comment'],
    $data['mood'],
    $data['color'],
    $data['disabled']
);
$stmt->execute();
echo json_encode(['status'=>'ok']);
?>
