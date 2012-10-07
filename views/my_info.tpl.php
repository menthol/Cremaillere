<form class="form-horizontal" action="<?php echo url($_GET['q']); ?>" method="post">
  <legend>Mes informations</legend>
  <div class="control-group">
    <label class="control-label" for="inputNom">Nom</label>
    <div class="controls">
      <input type="text" id="inputNom" placeholder="Nom" name="name" value="<?php echo $user->name; ?>" class="input-xxlarge">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputTel">Tel</label>
    <div class="controls">
      <input type="text" id="inputTel" placeholder="Tel" name="tel" value="<?php echo $user->tel; ?>" class="input-xxlarge">
      <small>Pour recevoir l’invitation par sms</small>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputRemarques">Remarques</label>
    <div class="controls">
      <textarea id="inputRemarques" placeholder="Remarques" name="more" rows="10" class="input-xxlarge"><?php echo $user->more; ?></textarea><br />
       <small>Indiquez si vous venez à plusieurs, vos limitations alimentaires, etc.</small>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Sauvegarder</button>
    </div>
  </div>
</form>
