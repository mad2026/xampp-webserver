<?php
function calculateProductDiscount($listPrice, $discountPercent) {
	return ($listPrice * $discountPercent * .01);
}//calculateProductDiscount

function cleanIO($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}//cleanIO
?>