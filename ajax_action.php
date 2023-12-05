
<?php
include_once 'config/Database.php';
include_once 'class/Records.php';

$database = new Database();
$db = $database->getConnection();

$record = new Records($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listRecords') {
	$record->listRecords();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {	
	$record->time = $_POST["time"];
    $record->lat = $_POST["lat"];
    $record->lng = $_POST["lng"];
    $record->event = $_POST["event"];
	$record->image = $_FILES["image"]["name"];
	//$record->handler = $_POST["handler"];
	//$record->checklist = $_POST["checklist"];
	$record->addRecord();

	if(!empty($_FILES['image']['name'])) {
        echo $_FILES['image']['tmp_name'];
        $targetDirectory = 'uploads/';  // 设置目标文件夹路径
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);  // 目标文件的完整路径

        // 将文件从临时位置移动到目标位置
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $record->image = $_FILES['image']['name'];  // 设置记录对象的image属性为文件名
        } else {
            echo "<script>alert('upload image fail')</script>";
        }
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$record->id = $_POST["id"];
	$record->getRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
	$record->time = $_POST["time"];
    $record->lat = $_POST["lat"];
    $record->lng = $_POST["lng"];
    $record->kind = $_POST["kind"];
	$record->image = $_FILES["image"]["tmp_name"];
	//$record->handler = $_POST["handler"];
	//$record->checklist = $_POST["checklist"];
	$record->updateRecord();
	// 其他字段赋值
    if(!empty($_FILES['image']['name'])) {
        $targetDirectory = 'uploads/';  // 设置目标文件夹路径
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);  // 目标文件的完整路径

        // 将文件从临时位置移动到目标位置
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $record->image = $_FILES['image']['name'];  // 设置记录对象的image属性为文件名
        } else {
            echo "<script>alert('upload image fail')</script>";
        }
    }
    // 更新记录的其他逻辑
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}


if (!empty($_FILES['file'])) {
    $file = $_FILES['file'];
    $json = file_get_contents($file['tmp_name']);
    $data = json_decode($json, true);
    //var_dump($data);
    $record->importData($data);
}

?>


