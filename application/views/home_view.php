<html>
	<head>
		<title>
			Crud Codeigniter
		</title>
	    <!--Bootstrap-->
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
	    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	    <!--ajax searching-->
	    <script type="text/javascript">
	    	$(document).ready(function(){
				$("#search").keyup(function(){
					if($("#search").val().length>0){
						var search = $("#search").val();
						$.ajax({
							type: "post",
							url: "<?php echo base_url().'crud/ajax_search';?>",				
							data: "search="+search,
							success: function(response){
								data = $.parseJSON(response);
								var items=[]; 

								$.each(data, function(i, item) {
									if(item.file != ""){
										var img_url = "<a href = '<?php echo base_url().'crud/download_attachment/';?>"+item.file+"'>";
										var img = "<?php echo base_url().'/uploads/';?>"+item.file;
									}else{
										var img_url = "";
										var img = "<?php echo base_url().'/uploads/no_preview.png';?>";
									}


									items.push("<tr><td>"+item.judul+"</td><td>"+item.pengarang+"</td><td>"+item.kategori+"</td><td>"+img_url+"<img height='100px' width='70px' src='"+img+"'/></td><td width='20%'><a title='Edit' href='<?php echo base_url().'crud/edit/'?>"+item.id+"' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span></a> <a  title='Delete' href='<?php echo base_url().'crud/delete/'?>"+item.id+"' class='btn btn-danger' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\"><span class='glyphicon glyphicon-trash'></span></a> <a title='Add Attachment' href='<?php echo base_url().'crud/add_attachment/'?>"+item.id+"' class='btn btn-success'><span class='glyphicon glyphicon-plus'></span></a></td></tr>");
								});
								$("#pagination").hide();
								$("#table_content").html(items);
							},
						});
					}
			  	});
			});
	    </script>
	</head>
	<body>
		<div id="wrapper">
			<!--header-->
			<?php $this->load->view('template/header');?>
			
			<!--navigation-->
			<?php $this->load->view('template/navigation');?>
			
			<!--content-->
			<?php $this->load->view($content);?>	
			
			<!--footer-->
			<?php $this->load->view('template/footer');?>
		</div>
	</body>
</html>