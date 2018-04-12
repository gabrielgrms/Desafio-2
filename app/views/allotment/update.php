<?php 
	require_once dirname(__FILE__).'/../../controllers/CondomController.php';
	require_once dirname(__FILE__).'/../../controllers/AllotmentController.php'; 
	$condoms = CondomController::read();
	$allotment = AllotmentController::read($_GET['id'])[0];
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>