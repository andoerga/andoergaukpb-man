<style>
body {
	font-family: courier;
}
</style>
<?php
$keys = array(
	'0' => ' ',
	'1' => 'A',
	'2' => 'B',
	'3' => 'C',
	'4' => 'D',
	'5' => 'E'
);
$output = '';
foreach($ujian as $u){
for($i=1;$i<=60;$i++){
		$output .= '&nbsp;';
	}
foreach($soal_map[$u->id] as $s){ 
$output .= $keys[$s->kunci]; 
}
}

$output .= '<br />';
 $n = 1; 
 foreach($peserta_ujian as $p){ 
 $score = 0; 
	
	$output .= $p['nama']; 
	$length = strlen($p['nama']);
	for($i=$length;$i<60;$i++){
		$output .= '&nbsp;';
	}
	//$output .=  $p['nip'] . '	'; 
	
	 foreach($ujian as $u){ 
		 $jawaban = json_decode($hasil[$p['user_id']][$u->id]->jawaban, true); 
		 $score += $hasil[$p['user_id']][$u->id]->score; 
		 foreach($soal_map[$u->id] as $s){ 
			 if(isset($jawaban[$s->id])){
				$output .= $keys[$jawaban[$s->id]]; 
			 }else{ 
				$output .= ' ';
			 } 
		 } 
	 } 
	$output .= '<br />';
 } 
 echo $output;