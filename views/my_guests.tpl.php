<?php
$status_strings = array(
  '',
  'Acceptée',
  'Peut-être',
  'Refusée'
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

<legend>Mes invitations <a class="btn btn-primary btn-small" href="<?php echo url('add_guest'); ?>">J'invite !</a></legend>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Invitation</th>
      <?php if (user()->is_admin): ?>
        <th>Inviteur</th>
        <th>Horaires</th>
        <th>Transport</th>
      <?php endif; ?>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($guests as $guest): ?>
      <tr>
        <td>
          <?php if (user()->is_admin): ?>
            <a href="<?php echo url('my_info/' . $guest->id); ?>"><?php echo $guest->name ?></a>
            <?php if(in_array($guest->status, array(1, 2))): ?>
            <small>
              <?php echo $guest->cnt_adults ? $guest->cnt_adults . ' Adulte<small>(s)</small>' : null; ?>
              <?php echo $guest->cnt_children ? $guest->cnt_children . ' Enfant<small>(s)</small>' : null; ?>
              <?php echo $guest->cnt_babies ? $guest->cnt_babies . ' Bébé<small>(s)</small>' : null; ?>
            </small>
            <?php endif; ?>
          <?php else: ?>
            <?php echo $guest->name ?>
          <?php endif; ?>
        </td>
        <td><?php echo $status_strings[$guest->status]; ?></td>
        <?php if (user()->is_admin): ?>
          <td><b><?php echo model('guest')->load($guest->inviter_id)->name; ?></b></td>
          <?php
          $time_arrival = array(
            '-',
            '14h/17h',
            '17h/20h',
            '20h/21h',
            '21h/2h',
            '2h/8h',
          );
          $time_departure = array(
            '-',
            '14h/17h',
            '17h/19h',
            '19h/21h',
            '21h/2h',
            '2h/8h',
            '8h/11h',
          );
          ?>
          <td>
            <small>
              <?php echo $time_arrival[$guest->arrival]; ?> -->
              <?php echo $time_departure[$guest->departure]; ?>
            </small>
          </td>
          <?php
          $transports = array(
            '',
            'A pieds / sur place',
            'transports',
            'en voiture',
            'Dépose',
          );
          ?>
          <td>
            <small><?php echo $transports[$guest->transport]; ?></small>
          </td>
        <?php endif; ?>
        <td>
          <a href="#" class="btn btn-primary btn-mini" rel="popover" data-content="<?php echo sms::generateMessage($guest); ?>" data-original-title="Message d'invitation">Voir l'invitation</a>
          <?php if (!empty($guest->tel)): ?>
            <?php if ($guest->sms): ?>
              <span class="btn btn-mini">Sms envoyé</span>
            <?php else: ?>
              <a href="<?php echo url('sendsms/' . $guest->id . '/1'); ?>" class="btn btn-primary btn-mini">Envoyer le sms</a>
            <?php endif; ?>
          <?php if ($guest->sms2): ?>
              <span class="btn btn-mini">Rappel envoyé</span>
            <?php else: ?>
            <?php if ($guest->status != 0): ?>
              <span class="btn btn-mini">Déjà repondu</span>
              <?php else: ?>
              <a href="<?php echo url('sendsms/' . $guest->id . '/2'); ?>" class="btn btn-primary btn-mini">Envoyer le rappel</a>
              <?php endif; ?>
            <?php else: ?>
            <?php endif; ?>
          <?php else: ?>
            <span class="btn btn-warning btn-mini">Manque num</span>
          <?php endif; ?>
          <?php if (user()->is_admin && !empty($guest->gift)): ?>
            <a href="#" class="btn btn-success btn-mini" rel="popover" data-content="<?php echo $guest->gift; ?>" data-original-title="Apports">Voir les apports</a>
          <?php endif; ?>
          <?php if (user()->is_admin && !empty($guest->more)): ?>
            <a href="#" class="btn btn-warning btn-mini" rel="popover" data-content="<?php echo $guest->more; ?>" data-original-title="Remarques">Voir les remarques</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
