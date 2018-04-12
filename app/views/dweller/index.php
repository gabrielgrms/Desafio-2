<?php
	require_once dirname(__FILE__).'/../../controllers/AllotmentController.php';
	require_once dirname(__FILE__).'/../../controllers/DwellerController.php';

	$dwellers = DwellerController::read();
?>	

<!DOCTYPE html>
	<title> Moradores </title>
	<?php include "../header.inc" ?>
		<h1> Todos os moradores </h1>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Email</th>
		      <th scope="col">Lote</th>
		      <th scope="col">Deletar</th>
		      <th scope="col">Editar</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php foreach($dwellers as $dweller): ?>
		  	<?php $allotment = AllotmentController::read($dweller->getAllotment_id())[0]; ?>
		    <tr>
		      <th scope="row">1</th>
		      <td><?= $dweller->getName(); ?></td>
		      <td><?= $dweller->getEmail(); ?></td>
		      <td><?= $allotment->getNumber(); ?></td>
		      <td><a href= "../../controllers/DwellerController.php?action=delete&id=<?=$dweller->getId()?>" ><button type="button" class="btn btn-danger">Deletar</button> </a></td>
		      <td><a href= "update.php?id=<?= $dweller->getId() ?>" ><button type="button" class="btn btn-danger">Editar</button> </a></td>
		    </tr>
		  <?php endforeach; ?>
		  </tbody>
		</table>
		<a href= "create.php" ><button type="button" class="btn btn-success">Adicionar novo morador</button> </a>
	<?php include "../footer.inc" ?>
