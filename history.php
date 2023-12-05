<?php 
include('inc/header.php');
?>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/ajax.js"></script>	
<?php include('inc/container_h.php');?>
<html>
<div class="container contact" >	
	<h2 style="padding-left : 10px;">紀錄表</h2>	
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   		
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<!-- <div class="col-md-10" align="right">
					<button type="button" name="importButton" id="importRecord" class="btn btn-success">Import</button>
				</div> -->
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="addRecord" class="btn btn-secondary">Add New Record</button>
				</div>
			</div>
		</div>
		<table id="recordListing" class="table table-bordered table-striped" >
			<thead>
				<tr>
					<th>#</th>
					<th>時間</th>					
					<th>經度</th>	
					<th>緯度</th>				
					<th>種類</th>
					<th>照片</th>
					<th>檢核表</th>				
				</tr>
			</thead>
		</table>
	</div>
	<div id="recordModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="recordForm" enctype="multipart/form-data">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Record</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="time" class="control-label">時間</label>
							<input type="datetime-local" class="form-control" id="time" name="time" placeholder="時間" >
						</div>
						<div class="form-group">
							<label for="lat" class="control-label">經度</label>							
							<input type="text" class="form-control" id="lat" name="lat" placeholder="經度">							
						</div>	   	
						<div class="form-group">
							<label for="lng" class="control-label">緯度</label>							
							<input type="text" class="form-control" id="lng" name="lng" placeholder="緯度">							
						</div>	  
						<div class="form-group">
							<label for="kind" class="control-label">種類</label>
							<select name="kind" class="form-control"  id="kind"  placeholder="種類" required>
                                <option value="fasten">扣件遺失</option>
                                <option value="railway">軌道彎曲</option>
                                <option value="obstacle">障礙物</option>
                            </select>							
						</div>	 
						<div class="form-group">
							<label for="image" class="control-label">照片</label>							
							<input type="file" class="form-control" id="image" name="image" accept="">
						</div>			
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

	<!-- import file -->
	<div id="fileModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="fileForm" enctype="multipart/form-data">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Import File</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="jsonFileInput" class="control-label">檔案</label>
							<input type="file" class="form-control" id="jsonFileInput" name="file" accept=".json" />
						</div>					
    				</div>
    				<div class="modal-footer">
    					<input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>


</div>	
</html>
<?php include('inc/footer.php');?>