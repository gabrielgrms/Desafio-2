<form action="../../controllers/CompaniesController.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="company[name]" aria-describedby="emailHelp" placeholder="Nome" value="<?= !empty($_GET['id']) ? $company->getName() : "" ?>">
  </div>
  <div class="form-group">
    <label for="CNPJ">Cnpj</label>
    <input type="text" class="form-control" name="company[cnpj]" id="CNPJ" placeholder="CNPJ" minlength="14" maxlength="14" value="<?= !empty($_GET['id']) ? $company->getCnpj() : "" ?>">
  </div>
	<?php if (isset($_GET['id'])): ?>
    <input type="hidden" class="form-control" name="company[id]" value="<?= $_GET['id'] ?>" >
	<?php endif; ?>

  <button type="submit" name="action" value="<?= !empty($_GET['id']) ? 'update' : 'create' ?>" class="btn btn-primary">Enviar</button>
</form>