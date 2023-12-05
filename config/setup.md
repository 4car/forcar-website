## Database.php


```php
<?php
// Database.php
class Database{
	
    private $host = "";
    private $user = "";
    private $password = "";
    private $database = ""; 

    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>
```

## Connect.php
```php
<?php
// Connect.php

    $servername = '';
    $username = '';
    $pass = '';
    $dbname = '';

    $conn = new mysqli($servername, $username, $pass, $dbname);

    if ($conn->connect_error) {
        die("fail: " . $conn->connect_error);
    }

?>
```

## record.sql
### database = `monitor`

- create database

### table = `record`

- create table

```sql
// record.sql
CREATE TABLE `record` (
  `id` tinyint(3) NOT NULL,
  `time` timestamp(6) NULL DEFAULT current_timestamp(6),
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `handler` char(10) DEFAULT NULL,
  `checklist` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### insert data into `record`

```sql
// record.sql
INSERT INTO `record` (`id`, `time`, `latitude`, `longitude`, `type`, `image`, `handler`, `checklist`) VALUES
(1, '2023-07-07 01:29:31.000000', '24.17933181343701', '120.65050822183082', 'fasten', 'fasten.jpg', 'ug0', '未檢查'),
(2, '2023-07-07 01:29:31.000000', '24.18039882559235', '120.6510094921438', 'railway', 'railway.jpg', 'ug0', '已檢查'),
(3, '2023-07-07 01:29:31.000000', '24.179664389611297', '120.65051328516732', 'railway', 'railway.jpg', 'ug0', '檢查中'),
(4, '2023-07-07 01:29:31.000000', '24.17972443799485', '120.65126772230501', 'fasten', 'fasten.jpg', 'ug0', '已檢查'),
(5, '2023-07-07 01:29:31.000000', '24.179715199783825', '120.65056898186874', 'railway', 'railway.jpg', 'ug0', '未檢查'),
(6, '2023-07-07 01:29:31.000000', '24.179511958972345', '120.65062974190668', 'obstacle', 'obstacle.jpg', 'ug0', '檢查中'),
(7, '2023-07-07 02:10:00.110000', '24.179364147269773', '120.6512626589685', 'railway', 'railway.jpg', 'jack', '檢查中'),
(8, '2023-07-07 02:25:04.000000', '24.179715199783825', '120.65056898186874', 'railway', 'railway.jpg', 'ug0', '未檢查');
```

## map.html
```php
// Secret.php
<?php
    $servername = '';
    $username = '';
    $pass = '';
    $dbname = '';
?>
<script>
    var api = "your_api_key";
<script>
```


