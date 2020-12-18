<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title($date).xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" width="100%">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">ID Siswa</th>
			<th class="text-center">Nama Siswa</th>
			<th class="text-center">Level</th>
			<th class="text-center">Cabang</th>
			<th class="text-center">Unit</th>
			<th class="text-center">Story</th>
			<th class="text-center">Time</th>
			<th class="text-center">Speed</th>
			<th class="text-center">Nada</th>
			<th class="text-center">Try</th>
			<th class="text-center">Status</th>
			<th class="text-center">Jumlah Salah</th>
			<th class="text-center">Tgl Upload</th>
			<th class="text-center">Tgl Masehi</th>
			<th class="text-center">Jam Upload</th>
			<th class="text-center">Note</th>
			<th class="text-center">Keterangan</th>
		</tr>
	</thead>
	<tbody>
        <?php 
			$no = 1;
			foreach($log_harian as $lh):
		?>
			<tr>
                <td align="center"><?=$no?>.</td>
				<td align="center"><?=$lh['id_siswa']?></td>
				<td align="center"><?=$lh['nama_siswa']?></td>
				<td align="center"><?=$lh['level']?></td>
				<td align="center"><?=$lh['nama_cabang']?></td>
				<td align="center"><?=$lh['unit']?></td>
				<td align="center"><?=$lh['story']?></td>
				<td align="center"><?=$lh['time']?></td>
				<td align="center"><?=$lh['nada']?></td>    
				<td align="center"><?=$lh['level']?></td>
				<td align="center"><?=$lh['try']?></td>
				<td align="center">
					<?php 
						if($lh['status'] == 0){
							echo "Pending";
						}else{
							echo "Reviewed";
						}
					?>
				</td>
				<td align="center"><?=$lh['jumlah_salah']?></td>
				<td align="center"><?=$lh['tgl_upload']?></td>
				<td align="center"><?=$lh['tgl_sebenarnya']?></td>
				<td align="center"><?=$lh['jam']?></td>
				<td align="center"><?=$lh['note']?></td>
				<td align="center">
					<?php 
						if($lh['status'] == 2){
							echo "Warning";
						}else if($lh['status'] == 3){
							echo "Goal";
						}else{
							echo "-";
						}
					?>
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>