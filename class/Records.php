<?php
class Records {	
   
	private $recordsTable = 'record';
	public $id;
    public $time;
    public $lat;
	public $lng;
	public $kind;
    public $image;
	//public $checklist;
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listRecords(){
		
		$sqlQuery = "SELECT * FROM ".$this->recordsTable." ";
		if(!empty($_POST["search"]["value"])){
			$searchValue = $_POST["search"]["value"];
			$sqlQuery .= 'WHERE (id LIKE "%'.$searchValue.'%" ';            
			$sqlQuery .= 'OR lat LIKE "%'.$searchValue.'%" ';
			$sqlQuery .= 'OR lng LIKE "%'.$searchValue.'%" ';
			$sqlQuery .= 'OR kind LIKE "%'.$searchValue.'%" ';
			//$sqlQuery .= 'OR handler LIKE "%'.$searchValue.'%" ';
			//$sqlQuery .= 'OR checklist LIKE "%'.$searchValue.'%" ';
			$sqlQuery .= 'OR image LIKE "%'.$searchValue.'%") ';
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->recordsTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($record = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $record['id'];
			$rows[] = $record['time'];
			$rows[] = $record['lng'];	
			$rows[] = $record['lat'];
			$rows[] = $record['kind'];	
			$blob_data = $record['image'];
			$rows[] = '<img src="data:image/jpeg;base64,'.base64_encode($blob_data).'" width=30% height=30% class="image-modal"/>';		
			//$rows[] = $record['checklist'];					
			//$rows[] = '<button event="button" name="update" id="'.$record["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$rows[] = '<button event="button" name="delete" id="'.$record["id"].'" class="btn btn-success btn-xs delete" >Checked</button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	public function getRecord(){
		if($this->id) {
			$sqlQuery = "
				SELECT * FROM ".$this->recordsTable." 
				WHERE id = ?";	
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	public function updateRecord(){
		if($this->id) {			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->recordsTable." 
			SET time= ?, lat = ?, lng = ?, kind = ?, image = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->time = htmlspecialchars(strip_tags($this->time));
			$this->lat = htmlspecialchars(strip_tags($this->lat));
			$this->lng = htmlspecialchars(strip_tags($this->lng));
			$this->kind = htmlspecialchars(strip_tags($this->kind));
			$this->image = htmlspecialchars(strip_tags($this->image));
			//$this->checklist = htmlspecialchars(strip_tags($this->checklist));
			
			
			$stmt->bind_param("sssssi", $this->time, $this->lat, $this->lng, $this->kind, $this->image, $this->id);

			

			if($stmt->execute()){
				echo "<script>alert('pass');</script>";
				return true;
			}
			if (!$stmt->execute()) {
				echo "Error: " . $stmt->error;
			}
			
		}	
	}
	public function addRecord(){
		
		if($this->time) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->recordsTable."(`time`, `lat`, `lng`, `kind`, `image`)
			VALUES(?,?,?,?,?)");
			
			$this->time = htmlspecialchars(strip_tags($this->time));
			$this->lat = htmlspecialchars(strip_tags($this->lat));
			$this->lng = htmlspecialchars(strip_tags($this->lng));
			$this->kind = htmlspecialchars(strip_tags($this->kind));
			$this->image = htmlspecialchars(strip_tags($this->image));
			//$this->checklist = htmlspecialchars(strip_tags($this->checklist));
			
			$stmt->bind_param("ssssss", $this->time, $this->lat, $this->lng, $this->kind, $this->image);
			
			if($stmt->execute()){
				return true;
			}
			
		}
	}
	public function deleteRecord(){
		if($this->id) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->recordsTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}

	public function importData($data) {
		// 解析$data中的資料並插入資料庫
		// 根據你的資料表結構來設定SQL語句並執行
		$sql = "INSERT INTO ".$this->recordsTable." (time, lat, lng , kind, image) 
		VALUES ( ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($sql);
		foreach ($data as $item) {
			$this->time = $item['time'];
			$this->lat = $item['lat'];
			$this->lng = $item['lng'];
			$this->kind = $item['kind'];
			$this->image = $item['image'];
			//$this->checklist = $item['checklist'];
	
			$stmt->bind_param("sssss", $this->time, $this->lat, $this->lng, $this->kind, $this->image);
			$stmt->execute();
		}
			
			echo "success";

			$stmt->close();
	  }

	  public function labelCount($whichtype) {
			$query = "SELECT COUNT(*) AS count FROM record WHERE type = .$whichtype.";
			$result = $conn->query($query);
			if ($result) {
				$row = $result->fetch_assoc();
				$typeCount = $row['count'];
				echo $typeCount;
			}
		}
	}
?>