<form action="../../controllers/CondomController.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="condom[name]" placeholder="Nome" value="<?= !empty($_GET['id']) ? $condom->getName() : "" ?>">
  </div>
  <div class="form-group">
    <label for="companies">Empresas</label>
    <select class="form-control" id="companies" name="condom[company_id]">
      <?php foreach($companies as $company): ?>
      	<?php if(isset($_GET['id']) && ($company->getId() == $condom->getCompany_id())): ?>
      		<option selected value="<?= $company->getId() ?>"> <?php echo $company->getName() ?> </option>
      	<?php endif; ?>
      	<?php if(!isset($_GET['id'])): ?>
      		<option value="<?= $company->getId() ?>"> <?php echo $company->getName() ?> </option>
      	<?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
	<?php if (isset($_GET['id'])): ?>
    <input type="hidden" class="form-control" name="condom[id]" value="<?= $_GET['id'] ?>" >
	<?php endif; ?>

  <button type="submit" name="action" value="<?= !empty($_GET['id']) ? 'update' : 'create' ?>" class="btn btn-primary">Enviar</button>
</form>