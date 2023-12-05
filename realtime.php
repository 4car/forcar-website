<?php include('inc/header.php');?>
<?php include('inc/container_r.php'); ?>

<style>
table.box{
    width: 800px;
    height: 250px;
    margin: auto;
}
table.box td{
  vertical-align: middle;
  text-align: center;
  padding: 10px;
}
</style>

<?php
    header("Refresh:2");
    date_default_timezone_set('Asia/Taipei');
    $currentDateTime = date('Y-m-d H:i:s');
    echo "<table border='1' class='box'><tr>". $currentDateTime. "</tr>";
    require_once('config/connect.php');
    $sql = "SELECT  * FROM `record` ORDER BY `id` DESC LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<tr>
                <td>ID</td>
                <td>時間</td>
                <td>經度</td>
                <td>緯度</td>
                <td>類型</td>
                <td>照片</td>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo " <td>". $row['id']."</td><td>". $row['time']."</td><td>". $row['lng']."</td><td>". $row['lat']."</td><td>". $row['kind']."</td><td>";
            // 取得 BLOB 資料
            $blob_data = $row['image'];
            // 顯示圖片
            echo '<img src="data:image/jpeg;base64,' . base64_encode($blob_data) . '" height=100px /></td>';
            echo '<tr/>';
            // 可以在這裡進行其他處理
        }
        echo "</table>";
    } else {
        echo "No data found";
    }

    $conn->close();
   
?>
<?php include('inc/footer.php'); ?>

