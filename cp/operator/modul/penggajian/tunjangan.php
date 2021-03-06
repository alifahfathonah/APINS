<?php 
require_once '../../inc/db_connect.php';
function TanggalIndo($tanggal)
{
	$bulan = array ('Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1]-1 ] . ' ' . $split[0];
};
$output = array('data' => array());
$sql = "SELECT * FROM id_pegawai order by pegawai_id asc";
$query = $connect->query($sql);
while ($row = $query->fetch_assoc()) {
	$idp=$row['pegawai_id'];
	$pegid=$row['ptk_id'];
	$namap = $connect->query("SELECT * FROM ptk WHERE ptk_id='$pegid'")->fetch_assoc();
	$pn = $connect->query("select * from gajipokok where pegawai_id='$idp'")->fetch_assoc();
	$tunj1 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['insentif'].'"  onBlur="simpankes(this,\'insentif\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['insentif'],0,",",".").'</span>
		';
	$tunj2 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['transport'].'"  onBlur="simpankes(this,\'transport\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['transport'],0,",",".").'</span>
		';
	$tunj3 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['tunj_walikelas'].'"  onBlur="simpankes(this,\'tunj_walikelas\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['tunj_walikelas'],0,",",".").'</span>
		';
	$tunj4 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['tunj_kepsek'].'"  onBlur="simpankes(this,\'tunj_kepsek\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['tunj_kepsek'],0,",",".").'</span>
		';
	$tunj5 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['tunj_kehadiran'].'"  onBlur="simpankes(this,\'tunj_kehadiran\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['tunj_kehadiran'],0,",",".").'</span>
		';
	$tunj6 = '
		<span class="input-group-addon" contenteditable="true" data-old_value="'.$pn['tunj_ekskul'].'"  onBlur="simpankes(this,\'tunj_ekskul\',\''.$idp.'\')" onClick="highlightEdit(this);">'.number_format($pn['tunj_ekskul'],0,",",".").'</span>
		';
	//$namasis=$pn['nama'];
	$output['data'][] = array(
		$idp,
		$namap['nama'],
		$tunj1,
		$tunj2,
		$tunj3,
		$tunj4,
		$tunj5,
		$tunj6
	);
}

// database connection close
$connect->close();

echo json_encode($output);