<?php
$status_strings = array(
  '-',
  'Acceptée',
  'Reportée',
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
            <small>
              <?php echo $guest->cnt_adults ? $guest->cnt_adults . ' Adultes' : null; ?>
              <?php echo $guest->cnt_children ? $guest->cnt_children . ' Enfants' : null; ?>
              <?php echo $guest->cnt_babies ? $guest->cnt_babies . ' Bébés' : null; ?>
            </small>
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
            '14h',
            '17h',
            '20h',
            '21h',
            '2h',
          );
          $time_departure = array(
            '-',
            '17h',
            '19h',
            '21h',
            '2h',
            '8h',
            '11h',
          );
          ?>
          <td>
            <small>
              <?php echo $time_arrival[$guest->arrival]; ?> -
              <?php echo $time_departure[$guest->departure]; ?>
            </small>
          </td>
        <?php endif; ?>
        <td>
          <?php if (!empty($guest->tel)): ?>
            <?php if ($guest->sms): ?>
              <span class="btn btn-mini">Sms envoyé</span>
            <?php else: ?>
              <a href="<?php echo url('sendsms/' . $guest->id); ?>" class="btn btn-primary btn-mini">Envoyer le sms</a>
            <?php endif; ?>
          <?php endif; ?>
          <?php if (user()->is_admin && !empty($guest->more)): ?>
            <a href="" class="btn btn-warning btn-mini" rel="popover" data-content="<?php echo $guest->more; ?>" data-original-title="Remarques">Voir les remarques</a>
          <?php endif; ?>
          <?php if (user()->is_admin && !empty($guest->gift)): ?>
            <a href="" class="btn btn-success btn-mini" rel="popover" data-content="<?php echo $guest->gift; ?>" data-original-title="Apports">Voir les apports</a>
          <?php endif; ?>
            <a href="" class="btn btn-primary btn-mini" rel="popover" data-content="<?php echo sms::generateMessage($guest); ?>" data-original-title="Message d'invitation">Voir l'invitation</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
