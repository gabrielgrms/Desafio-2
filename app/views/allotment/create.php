<?php 
require_once dirname(__FILE__).'/../../controllers/AllotmentController.php';
require_once dirname(__FILE__).'/../../controllers/CondomController.php'; 
$condoms = CondomController::read();
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>