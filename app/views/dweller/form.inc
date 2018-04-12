<form action="../../controllers/DwellerController.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Nome</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="dweller[name]" placeholder="Nome" value="<?= !empty($_GET['id']) ? $dweller->getName() : '' ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="dweller[email]" value="<?= !empty($_GET['id']) ? $dweller->getEmail() : '' ?>">
  </div>
  <div class="form-group">
    <label for="allotments">Lotes</label>
    <select class="form-control" id="allotments" name="dweller[allotment_id]">
      <?php foreach($allotments as $allotment): ?>
      	<?php if(isset($_GET['id']) && ($allotment->getId() == $dweller->getAllotment_id())): ?>
      		<option selected value="<?= $allotment->getId() ?>"> <?php echo $allotment->getNumber() ?> </option>
      	<?php endif; ?>
      	<?php if(!isset($_GET['id']) || ($allotment->getId() != $dweller->getAllotment_id())): ?>
      		<option value="<?= $allotment->getId() ?>"> <?php echo $allotment->getNumber() ?> </option>
      	<?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
	<?php if (isset($_GET['id'])): ?>
    <input type="hidden" class="form-control" name="dweller[id]" value="<?= $_GET['id'] ?>" >
	<?php endif; ?>

  <button type="submit" name="action" value="<?= !empty($_GET['id']) ? 'update' : 'create' ?>" class="btn btn-primary">Enviar</button>
</form>