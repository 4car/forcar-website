<?php
require_once('config/connect.php');

// 执行数据库查询
$sql = "SELECT `lat`,`lng`,`kind` FROM record";
$result = $conn->query($sql);

// 获取查询结果并将其转换为 JSON 格式
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
