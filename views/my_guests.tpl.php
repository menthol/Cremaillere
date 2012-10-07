<?php
$status_strings = array(
  'Je n\'ai pas encore repondu',
  'Je viens !',
  'Je ne sais pas...',
  'Je ne viens pas.'
);
?>
<legend>Mon inviteur</legend>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Invitation</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $inviter->name ?></td>
      <td><?php echo $status_strings[$inviter->status]; ?></td>
    </tr>
  </tbody>
</table>

<legend>Mes invitations</legend>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Invitation</th>
      <?php if (user()->is_admin): ?>
        <th>Inviteur</th>
      <?php endif; ?>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($guests as $guest): ?>
      <tr>
        <td><?php echo $guest->name ?></td>
        <td><?php echo $status_strings[$guest->status]; ?></td>
        <?php if (user()->is_admin): ?>
          <td><b><?php echo model('guest')->load($guest->inviter_id)->name; ?></b></td>
        <?php endif; ?>
        <td>
          <?php if (!empty($guest->tel)): ?>
            <?php if ($guest->sms): ?>
              Sms envoyé
            <?php else: ?>
              <a href="<?php echo url('sendsms/' . $guest->id); ?>" class="btn btn-primary btn-mini">Envoyer le sms</a>
            <?php endif; ?>
            -
          <?php endif; ?>
          <?php if (user()->is_admin && !empty($guest->more)): ?>
            <a href="#" class="btn btn-warning btn-mini" rel="popover" data-content="<?php echo $guest->more; ?>" data-original-title="Remarques">Voir les remarques</a>
             -
          <?php endif; ?>
            <a href="#" class="btn btn-primary btn-mini" rel="popover" data-content="<?php echo sms::generateMessage($guest); ?>" data-original-title="Message d'invitation">Voir l'invitation</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
