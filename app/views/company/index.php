<?php
	require_once dirname(__FILE__).'/../../controllers/CompaniesController.php';

	$companies = CompaniesController::read();
?>	

<!DOCTYPE html>
	<title> Empresas </title>
	<?php include "../header.inc" ?>
		<h1> Todas as empresas </h1>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Cnpj</th>
		      <th scope="col">Deletar</th>
		      <th scope="col">Editar</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php foreach($companies as $company): ?>
		    <tr>
		      <th scope="row">1</th>
		      <td><?= $company->getName(); ?></td>
		      <td><?= $company->getCnpj(); ?></td>
		      <td><a href= "../../controllers/CompaniesController.php?action=delete&id=<?=$company->getId()?>" ><button type="button" class="btn btn-danger">Deletar</button> </a></td>
		      <td><a href= "update.php?id=<?= $company->getId() ?>" ><button type="button" class="btn btn-danger">Editar</button> </a></td>
		    </tr>
		  <?php endforeach; ?>
		  </tbody>
		</table>
		<a href= "create.php" ><button type="button" class="btn btn-success">Adicionar nova empresa</button> </a>
	<?php include "../footer.inc" ?>
