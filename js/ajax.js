$(document).ready(function(){	
	
	var dataRecords = $('#recordListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"ajax_action.php",
			type:"POST",
			data:{action:'listRecords'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0,6, 6],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	
	
	$('#addRecord').click(function(){
		$('#recordModal').modal('show');
		$('#recordForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Record");
		$('#action').val('addRecord');
		$('#save').val('Add');
	});	

	$("#recordListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		$.ajax({
			url:'ajax_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#time').val(data.time);
				$('#lat').val(data.lat);
				$('#lng').val(data.lng);
				$('#kind').val(data.kind);				
				$('#image').val(data.image);
				//$('#handler').val(data.handler);	
				//$('#checklist').val(data.checklist);	
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Records");
				$('#action').val('updateRecord');
				$('#save').val('Save');
				dataRecords.ajax.reload();
			}
		})
	});
	$("#recordModal").on('submit', '#recordForm', function(event) {
		event.preventDefault();
		$('#save').attr('disabled', 'disabled');
		var formData = new FormData(this);
		$.ajax({
			url: "ajax_action.php",
			method: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				$('#recordForm')[0].reset();
				$('#recordModal').modal('hide');
				$('#save').attr('disabled', false);
			}
		});
	});	
	
	$("#recordListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteRecord";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"ajax_action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					dataRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	

	$('#importRecord').click(function(){
		$('#fileModal').modal('show');
		$('#fileForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Import File");
		$('#import').val('Import');
	});	

	$("#fileModal").on('submit', '#fileForm', function(event) {
		event.preventDefault();
		$('#import').attr('disabled', 'disabled');
		var formData = new FormData(this);
		$.ajax({
			url: "ajax_action.php",
			method: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				$('#fileForm')[0].reset();
				$('#fileModal').modal('hide');
				$('#import').attr('disabled', false);
				dataRecords.ajax.reload();
			}
		});
	});	

	$(".img-modal").click(function(){
		alert('show');
	})
	
});