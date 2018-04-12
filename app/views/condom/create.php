<?php 
require_once dirname(__FILE__).'/../../controllers/CompaniesController.php';
require_once dirname(__FILE__).'/../../controllers/CondomController.php'; 
$companies = CompaniesController::read();
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>