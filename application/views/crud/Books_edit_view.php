<body>
<div class="panel panel-default">
        <div class="panel-heading">Edit Buku</div>
	<?php echo form_open('crud/edit/'.$book->id);?>
	<table id="myTable" class="table table-striped table-hover tablesorter" cellspacing="0">
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td><input type="text" id="judul" name="judul" value="<?php echo (set_value('judul') == '')?$book->judul:set_value('judul'); ?>" /></td>
		</tr>
		<tr>
			<td>Pengarang</td>
			<td>:</td>
			<td><input type="text" id="pengarang" name="pengarang" value="<?php echo (set_value('pengarang') == '')?$book->pengarang:set_value('pengarang');; ?>" /></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td>:</td>
			<td><input type="text" id="kategori" name="kategori" value="<?php echo (set_value('kategori') == '')?$book->kategori:set_value('kategori');; ?>" /></td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Simpan"/>
	<?php echo form_close();?>
</div>
</body>