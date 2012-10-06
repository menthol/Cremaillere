<form class="form-horizontal" action="<?php echo url($_GET['q']); ?>" method="post">
  <legend>J'invite</legend>
  <div class="control-group">
    <label class="control-label" for="inputNom">Nom</label>
    <div class="controls">
      <input type="text" id="inputNom" placeholder="Nom" name="name" value="<?php echo $name; ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputTel">Tel</label>
    <div class="controls">
      <input type="text" id="inputTel" placeholder="Tel" name="tel" value="<?php echo $tel; ?>">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Inviter</button>
    </div>
  </div>
</form>
