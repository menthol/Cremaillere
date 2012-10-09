<form class="form-horizontal" action="<?php echo url($_GET['q']); ?>" method="post">
  <legend>Mes informations</legend>
  <div class="control-group">
    <label class="control-label" for="inputNom">Status</label>
    <div class="controls">
      <div class="btn-group">
        <span class="btn <?php echo $user->status == 1 || $user->status == 0 ? 'btn-success' : 'active'; ?>">Je viens !</span>
        <span class="btn <?php echo $user->status == 2 || $user->status == 0 ? 'btn-warning' : 'active'; ?>">Je ne sais pas.</span>
        <span class="btn <?php echo $user->status == 3 || $user->status == 0 ? 'btn-danger' : 'active'; ?>">Je ne peux pas !</span>
      </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputNom">Nom</label>
    <div class="controls">
      <input type="text" id="inputNom" placeholder="Nom" name="name" value="<?php echo $user->name; ?>" class="input-xxlarge">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputTel">Tel</label>
    <div class="controls">
      <input type="text" id="inputTel" placeholder="Tel" name="tel" value="<?php echo $user->tel; ?>" class="input-xxlarge"><br />
      <small>Pour recevoir l’invitation par sms</small>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputGift">J'apporte</label>
    <div class="controls">
      <textarea id="inputGift" placeholder="J'apporte" name="gift" rows="3" class="input-xxlarge"><?php echo $user->gift; ?></textarea><br />
       <small>Ce n'est pas obligatoire d'apporter quelque chose.</small>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputRemarques">Remarques</label>
    <div class="controls">
      <textarea id="inputRemarques" placeholder="Remarques" name="more" rows="5" class="input-xxlarge"><?php echo $user->more; ?></textarea><br />
       <small>Vos limitations alimentaires, vos demandes, etc.</small>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputTransport">Mode de transport</label>
    <div class="controls">
      <select id="inputTransport" name="transport">
        <?php
          $transports = array(
            '-',
            'A pieds',
            'En transports en commun',
            'En voiture',
            'On me dépose',
          );
          foreach($transports as $delta => $transport) {
            if ($delta == $user->transport) {
              echo '<option value="' . $delta . '" selected="selected">' . $transport . '</option>';
            }
            else {
              echo '<option value="' . $delta . '">' . $transport . '</option>';
            }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputArrival">J'arrive</label>
    <div class="controls">
      <select id="inputArrival" name="arrival">
        <?php
          $time_select = array(
            '-',
            '14h - 17h : activités jeux et activités enfants.',
            '17h - 19h : accueil des invités, activités jeux, apéritifs.',
            '20h - 21h : buffet.',
            '21h - 2h : The Crémaillère Party.',
          );
          foreach($time_select as $delta => $activite) {
            if ($delta == $user->arrival) {
              echo '<option value="' . $delta . '" selected="selected">' . $activite . '</option>';
            }
            else {
              echo '<option value="' . $delta . '">' . $activite . '</option>';
            }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputDeparture">Je repars</label>
    <div class="controls">
      <select id="inputDeparture" name="departure">
        <?php
          $time_select = array(
            '-',
            '14h - 17h : activités jeux et activités enfants.',
            '17h - 19h : accueil des invités, activités jeux, apéritifs.',
            '20h - 21h : buffet.',
            '21h - 2h : The Crémaillère Party.',
            '2h - 8h : The After Crémaillère',
            '8h - 11h : petit déj',
          );
          foreach($time_select as $delta => $activite) {
            if ($delta == $user->departure) {
              echo '<option value="' . $delta . '" selected="selected">' . $activite . '</option>';
            }
            else {
              echo '<option value="' . $delta . '">' . $activite . '</option>';
            }
          }
        ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Nous sommes</label>
    <div class="controls">
      <input type="text" id="inputCntAdults" placeholder="Adultes" name="cnt_adults" value="<?php echo $user->cnt_adults; ?>" class="input-mini">
      Adultes<br />
      <input type="text" id="inputCntChildren" placeholder="Enfants" name="cnt_children" value="<?php echo $user->cnt_children; ?>" class="input-mini">
      Enfants<br />
      <input type="text" id="inputCntBabies" placeholder="Bébés" name="cnt_babies" value="<?php echo $user->cnt_babies; ?>" class="input-mini">
      Bébés
    </div>
  </div>
  <?php if (user()->is_admin): ?>
  <blockquote>
    <fieldset>
      <legend>Info d'administration</legend>
        <div class="control-group">
          <label class="control-label" for="inputIsAdmin">Administrateur</label>
          <div class="controls">
            <select id="inputIsAdmin" name="is_admin">
              <option value="0"<?php echo $user->is_admin ? null : ' selected="selected"'; ?>>Non</option>
              <option value="1"<?php echo $user->is_admin ? ' selected="selected"' : null; ?>>Oui</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputStatus">Statut</label>
          <div class="controls">
            <select id="inputStatus" name="status">
              <?php
              $status_strings = array(
                'Je n\'ai pas encore repondu',
                'Je viens !',
                'Je ne sais pas...',
                'Je ne viens pas.'
              );
              foreach($status_strings as $delta => $status) {
                if ($delta == $user->status) {
                  echo '<option value="' . $delta . '" selected="selected">' . $status . '</option>';
                }
                else {
                  echo '<option value="' . $delta . '">' . $status . '</option>';
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputInviter">Inviteur</label>
          <div class="controls">
            <select id="inputinviter" name="inviter_id">
              <?php
              foreach(model('guest')->load('*', true) as $inviter) {
                if ($inviter->id == $user->inviter_id) {
                  echo '<option value="' . $inviter->id . '" selected="selected">' . $inviter->name . '</option>';
                }
                else {
                  echo '<option value="' . $inviter->id . '">' . $inviter->name . '</option>';
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputSms">sms</label>
          <div class="controls">
            <select id="inputSms" name="sms">
              <option value="0"<?php echo $user->sms ? null : ' selected="selected"'; ?>>Non envoyé</option>
              <option value="1"<?php echo $user->sms ? ' selected="selected"' : null; ?>>Envoyé</option>
            </select>
          </div>
        </div>
    </fieldset>
  </blockquote>
  <?php endif; ?>
  <div class="form-actions">
      <button type="submit" class="btn btn-primary">Sauvegarder</button>
  </div>
</form>
