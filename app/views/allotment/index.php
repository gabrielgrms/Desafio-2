<?php
	require_once dirname(__FILE__).'/../../controllers/CondomController.php';
	require_once dirname(__FILE__).'/../../controllers/AllotmentController.php';

	$allotments = AllotmentController::read();
?>	

<!DOCTYPE html>
	<title> Lotes </title>
	<?php include "../header.inc" ?>
		<h1> Todos os Lotes </h1>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Número</th>
		      <th scope="col">Condomínio</th>
		      <th scope="col">Deletar</th>
		      <th scope="col">Editar</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php foreach($allotments as $allotment): ?>
		  	<?php $condom = CondomController::read($allotment->getcondom_id())[0]; ?>
		    <tr>
		      <th scope="row">1</th>
		      <td><?= $allotment->getNumber(); ?></td>
		      <td><?= $condom->getName(); ?></td>
		      <td><a href= "../../controllers/AllotmentController.php?action=delete&id=<?=$allotment->getId()?>" ><button type="button" class="btn btn-danger">Deletar</button> </a></td>
		      <td><a href= "update.php?id=<?= $allotment->getId() ?>" ><button type="button" class="btn btn-warning">Editar</button> </a></td>
		    </tr>
		  <?php endforeach; ?>
		  </tbody>
		</table>
		<a href= "create.php" ><button type="button" class="btn btn-success">Adicionar novo lote</button> </a>
	<?php include "../footer.inc" ?>
