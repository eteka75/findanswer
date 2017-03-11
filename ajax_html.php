<?php
require_once 'config.php';

if( isset( $_POST['start'] ) && isset( $_POST['limit'] ) && !empty( $_POST['start'] ) && !empty( $_POST['limit'] ) ){
	$start = $_POST['start'];
	$limit = $_POST['limit'];
	$query = "SELECT * FROM timeline limit $start, $limit";
	$result = mysqli_query($con, $query) or die('Error: ' . mysqli_error($con));
	$data = array();
	$rowcount = mysqli_num_rows($result);
	$data['count'] = $rowcount;
	$html = '';
	while($row = mysqli_fetch_assoc($result)) {
		$html .= '<li class="event">';
		$html .= '<h3 class="heading">'.$row['name'].'</h3>';
		$html .= '<span class="month"><i class="fa fa-calendar"></i>'.$row['name'].'</span><p>&nbsp;</p>';
		$html .= '<p><a href="'.$row['demo'].'" target="_blank">Demo </a></p>';
		$html .= '<p><a href="'.$row['tutorial'].'" target="_blank">Tutorial </a></p>';
			
		if($row['media_type'] == 'video' && $row['media'] !=''){
			$html .= '<div class="embed-responsive embed-responsive-16by9">';
			$html .= '<iframe frameborder="0" allowfullscreen="allowfullscreen" src="'.$row['media'].'" class="embed-responsive-item"></iframe>';
			$html .= '</div>';
		}
		if($row['media_type'] == 'image' && $row['media'] !='' ){
			$html .= '<div class="text-center">';
			$html .= '<img class="img-responsive img-thumbnail" src="'.$row['media'].'">';
			$html .= '</div>';
		}
		$html .= '<p>'.$row['description'].'</p>';
		$html .= '</li>';
	}
	mysqli_close($con);
	echo $html;exit;	
}
