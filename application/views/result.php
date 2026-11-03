<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table border="1">
		<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">NIP</th>
			<th rowspan="2">Nama</th>
			<th rowspan="2">Instansi</th>
			<?php foreach($ujian as $u){ ?>
			<th colspan="<?php echo count($soal_map[$u->id]); ?>"><?php echo $u->nama_ujian; ?></th>
			<?php } ?>
			<th rowspan="3">Skor</th>
		</tr>
		<tr>
			<?php foreach($ujian as $u){ ?>
			<?php foreach($soal_map[$u->id] as $s){ ?>
			<th><?php echo $s->id; ?></th>
			<?php } ?>
			<?php } ?>
			<th></th>
		</tr>
		<tr>
			<th colspan="4">Kunci Jawaban</th>
			<?php foreach($ujian as $u){ ?>
			<?php foreach($soal_map[$u->id] as $s){ ?>
			<th><?php echo $s->kunci; ?></th>
			<?php } ?>
			<?php } ?>
		</tr>
		<?php $n = 1; ?>
		<?php foreach($peserta_ujian as $p){ ?>
		<?php $score = 0; ?>
		<tr>
			<th><?php echo $n++; ?></th>
			<th>'<?php echo $p['nip']; ?></th>
			<th><?php echo $p['nama']; ?></th>
			<th><?php echo $p['instansi']; ?></th>
			<?php foreach($ujian as $u){ ?>
				<?php $jawaban = json_decode($hasil[$p['user_id']][$u->id]->jawaban, true); ?>
				<?php $score += $hasil[$p['user_id']][$u->id]->score; ?>
				<?php foreach($soal_map[$u->id] as $s){ ?>
					<?php if(isset($jawaban[$s->id])){?>
						<td bgcolor="<?php echo $s->kunci == $jawaban[$s->id] ? "green" : "red"; ?>"><?php echo $jawaban[$s->id]; ?></td>
					<?php }else{ ?>
						<td></td>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<th><?php echo $score; ?></th>
		</tr>
		<?php } ?>
	</table>
</body>
</html>