<?php 
require_once dirname(__FILE__).'/../../controllers/DwellerController.php';
require_once dirname(__FILE__).'/../../controllers/AllotmentController.php'; 
$allotments = AllotmentController::read();
?>
<!DOCTYPE html>
	<?php include "../header.inc" ?>
	<?php include "form.inc" ?>
	<?php include "../footer.inc" ?>