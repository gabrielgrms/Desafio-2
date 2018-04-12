<?php
	require_once dirname(__FILE__).'/../../controllers/CondomController.php';
	require_once dirname(__FILE__).'/../../controllers/CompaniesController.php';

	$condoms = CondomController::read();
?>	

<!DOCTYPE html>
	<title> Condomínios </title>
	<?php include "../header.inc" ?>
		<h1> Todos os condomínios </h1>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Empresa</th>
		      <th scope="col">Deletar</th>
		      <th scope="col">Editar</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php foreach($condoms as $condom): ?>
		  	<?php $company = CompaniesController::read($condom->getCompany_id())[0]; ?>
		    <tr>
		      <th scope="row">1</th>
		      <td><?= $condom->getName(); ?></td>
		      <td><?= $company->getName(); ?></td>
		      <td><a href= "../../controllers/CondomController.php?action=delete&id=<?=$condom->getId()?>" ><button type="button" class="btn btn-danger">Deletar</button> </a></td>
		      <td><a href= "update.php?id=<?= $condom->getId() ?>" ><button type="button" class="btn btn-danger">Editar</button> </a></td>
		    </tr>
		  <?php endforeach; ?>
		  </tbody>
		</table>
		<a href= "create.php" ><button type="button" class="btn btn-success">Adicionar novo condomínio</button> </a>
	<?php include "../footer.inc" ?>
