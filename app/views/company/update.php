<?php 
	require_once dirname(__FILE__).'/../../controllers/CompaniesController.php';

	$company = CompaniesController::read($_GET['id'])[0];
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>