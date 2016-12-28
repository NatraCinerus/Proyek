<div id="content">
<div class="panel panel-default">
	<div class="panel-heading">List Buku</div>

	<table id="myTable" class="table table-striped table-hover tablesorter" cellspacing="0">
		<thead>
		<tr>			
			<th colspan="4">
				<div class="btn-group">
					<a href="<?php echo base_url('crud/add') ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></a>
				</div>
			</th>
			<th>
				<?php //echo form_open('crud/search');?>
					<div class="form-group has-feedback">
						<label for="search" class="sr-only">Search</label>
						<input type="text" class="form-control" name="search" id="search" placeholder="search">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				<?php //echo form_close();?>
			</th>
		</tr>
		<tr>			
			<th>Judul</th>
			<th>Pengarang</th>
			<th>Kategori</th>
			<th>Gambar</th>
			<th>Opsi</th>
		</tr>
		</thead>
		<tbody id="table_content">
		<?php foreach($books as $value){
		?>
			<tr>			
				<td><?php echo $value->judul; ?></td>
				<td><?php echo $value->pengarang; ?></td>
				<td><?php echo $value->kategori; ?></td>
				<td>
					<?php if($value->file != ""){?>
						<a href="<?php echo base_url().'crud/download_attachment/'.$value->file; ?>"><img height="100px" width="70px" src="<?php echo base_url().'/uploads/'.$value->file; ?>"/></a>
					<?php }else{?>	
						<img height="100px" width="70px" src="<?php echo base_url().'/uploads/no_preview.png' ?>"/>
					<?php }?>
				</td>
				<td width="20%">
					<a title="Edit" href="<?php echo base_url().'crud/edit/'.$value->id ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a> <a title="Delete" href="<?php echo base_url().'crud/delete/'.$value->id ?>" class="btn btn-danger" onClick='return confirm("Anda yakin ingin menghapus data ini?")'><span class="glyphicon glyphicon-trash"></span></a> <a title="Add Attachment" href="<?php echo base_url().'crud/add_attachment/'.$value->id ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
				</td>
			</tr>
		<?php 
		}
		?>
		</tbody>
	</table>
</div>
<div id="pagination">
<?php 
	if(!empty($pagination)){
		echo $pagination;
	}
?>
</div>
</div>