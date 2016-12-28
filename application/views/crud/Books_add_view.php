<body>
 <div class="panel panel-default">
        <div class="panel-heading">Tambah Buku</div>
	<?php echo form_open('crud/add');?>
	<table id="myTable" class="table table-striped table-hover tablesorter" cellspacing="0">
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td><input type="text" id="judul" name="judul"value="<?php echo set_value('judul'); ?>" /></td>
		</tr>
		<tr>
			<td>Pengarang</td>
			<td>:</td>
			<td><input type="text" id="pengarang" name="pengarang" value="<?php echo set_value('pengarang'); ?>" /></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td>:</td>
			<td><input type="text" id="kategori" name="kategori" value="<?php echo set_value('kategori'); ?>" /></td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Tambah"/>
	<?php echo form_close();?>
</div>
</body>