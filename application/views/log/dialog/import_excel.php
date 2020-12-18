<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$title().xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border="1" width="100%">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">Nama User</th>
			<th class="text-center">Email User</th>
			<th class="text-center">Nama Event</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Point</th>
		</tr>
	</thead>
	<tbody>
        <?php 
            $no = 1; 
            foreach($log_event as $l) :
		?>
			<tr>
                <td align="center"><?=$no?>.</td>
				<td align="center"><?=$l['user_name']?></td>
				<td align="center"><?=$l['user_email']?></td>
				<td align="center"><?=$l['event_name']?></td>
				<td align="center"><?=$l['event_date']?></td>
				<td align="center"><?=$l['event_point']?></td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>