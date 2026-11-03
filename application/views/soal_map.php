<!DOCTYPE html>
<html>
	<head>
	
	</head>
	<body>
		<table border="1">
			<tr>
				<th>Id</th>
				<th>Mata Diklat</th>
				<th>Tipe Soal</th>
				<th>Soal</th>
				<th>Kunci</th>
				<th>Pil 1</th>
				<th>Pil 2</th>
				<th>Pil 3</th>
				<th>Pil 4</th>
				<th>Pil 5</th>
			</tr>
			<?php foreach($soal_map as $thissoal){ ?>
			<?php foreach($thissoal as $s){ ?>
			<tr>
				<td><?php echo $s->id; ?></td>
				<td><?php echo $ujian_map[$s->ujian_id]->nama_ujian; ?></td>
				<td><?php echo $s->tipe_soal; ?></td>
				<td><?php echo $s->soal; ?></td>
				<td><?php echo $s->kunci; ?></td>
				<td><?php echo $s->pil_1; ?></td>
				<td><?php echo $s->pil_2; ?></td>
				<td><?php echo $s->pil_3; ?></td>
				<td><?php echo $s->pil_4; ?></td>
				<td><?php echo $s->pil_5; ?></td>
			</tr>
			<?php } ?>
			<?php } ?>
		</table>
	</body>
</html>