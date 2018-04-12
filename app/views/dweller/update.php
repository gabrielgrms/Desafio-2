<?php 
	require_once dirname(__FILE__).'/../../controllers/AllotmentController.php';
	require_once dirname(__FILE__).'/../../controllers/DwellerController.php'; 
	$allotments = AllotmentController::read();
	$dweller = DwellerController::read($_GET['id'])[0];
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>