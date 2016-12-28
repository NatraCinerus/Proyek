<tr>
	<td>Upload File</td>
	<td>:</td>
	<td>
		<?php echo form_open_multipart('crud/add_attachment/'.$book->id);?>
		<input type="file" id="userfile" name="userfile"/>
		<input type="submit" name="upload" value="Upload"/>
		<?php echo form_close();?>
	</td>
</tr>