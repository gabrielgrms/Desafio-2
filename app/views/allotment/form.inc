<form action="../../controllers/AllotmentController.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Número</label>
    <input type="number" class="form-control" id="exampleInputEmail1" name="allotment[number]" value="<?= !empty($_GET['id']) ? $allotment->getNumber() : '' ?>">
  </div>
  <div class="form-group">
    <label for="condoms">Empresas</label>
    <select class="form-control" id="condoms" name="allotment[condom_id]">
      <?php foreach($condoms as $condom): ?>
      	<?php if(isset($_GET['id']) && ($condom->getId() == $allotment->getcondom_id())): ?>
      		<option selected value="<?= $condom->getId() ?>"> <?php echo $condom->getName() ?> </option>
      	<?php endif; ?>
      	<?php if(!isset($_GET['id']) || ($condom->getId() != $allotment->getcondom_id())): ?>
      		<option value="<?= $condom->getId() ?>"> <?php echo $condom->getName() ?> </option>
      	<?php endif; ?>
      <?php endforeach; ?>
    </select>
  </div>
	<?php if (isset($_GET['id'])): ?>
    <input type="hidden" class="form-control" name="allotment[id]" value="<?= $_GET['id'] ?>" >
	<?php endif; ?>

  <button type="submit" name="action" value="<?= !empty($_GET['id']) ? 'update' : 'create' ?>" class="btn btn-primary">Enviar</button>
</form>