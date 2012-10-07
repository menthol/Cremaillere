<div class="row">
    <div class="span8">
        <div class="hero-unit">
            <h1>Oyé <?php echo $name; ?> !</h1>
            <p>
              <?php if ($inviter == 'Nath'):?>
                  Envie de faire la fête? Rdv le <b>27 octobre 2012</b> chez moi pour ma cremalière !
              <? else: ?>
                  Envie de faire la fête? Rdv le <b>27 octobre 2012</b> chez nath pour sa cremalière !
              <?php endif; ?>
              <br />
              <small>Tu as été invité par <b><?php echo $inviter; ?></b>.</small>
            </p>
        </div>
    </div>
    <div class="span4">
        <h2>The Programme</h2>
        <h4>14h - 17h</h4> activités jeux et activités enfants.<br />
        <h4>19h - 20h</h4> accueil des invités, apéritifs.<br />
        <h4>20h - 21h</h4> buffet.<br />
        <h4>À partir de 21h</h4> <b><i>Let The Party Begin !!!</i></b>
    </div>
</div>
<div class="row">
    <div class="span8">
        <p>
          <?php
          $status_strings = array(
            'Je n\'ai pas encore repondu',
            'Je viens !',
            'Je ne sais pas...',
            'Je ne viens pas.'
          );
          ?>
        <blockquote>
          <h3>The Réponse</h3>
          <p>
            <a href="<?php echo url('actions/guests/1'); ?>" class="btn btn-info">Cool ! je viens !</a>
            <a href="<?php echo url('actions/guests/2'); ?>" class="btn">Arf, je ne sais pas encore.</a>
            <a href="<?php echo url('actions/guests/3'); ?>" class="btn btn-warning">Domage, je ne peux pas !</a>
          </p>
          <small>Réponse actuelle : <b><span style="color:#000000;"><?php echo $status_strings[$status]; ?></span></b></small>
        </blockquote>
        </p>
    </div>
    <div class="span4">
        <h3>The invitation</h3>
        <p>
            <a class="btn btn-primary" href="<?php echo url('add_guest'); ?>">J'invite !</a>
            <a class="btn btn-primary" href="<?php echo url('my_guests'); ?>">Mes invités</a>
        </p>
    </div>
</div>


<!-- Main hero unit for a primary marketing message or call to action -->


<!-- Example row of columns -->
<div class="row">
    <div class="span4">
        <h2>The Menu</h2>
        <p>
        <h4>Apéritifs</h4>
        Amuse-bouche (pâté salé, bouché de pain)<br />
        Samoussa<br />
        Ailes de poulet frit<br />
        <h4>Plat de résistance</h4>
        riz<br />
        colombo de poulet<br />
        hachis parmentier<br />
        <h4>Desserts</h4>
        Pâtisseries<br />
        Salade de fruits
        </p>
    </div>
    <div class="span4">
        <h2>The Adresse</h2>
        L'évenement ce deroulera a l'adresse suivante : <br />
        <blockquote>
          <p>
            Résidence Daufine<br />
            17 boulevard Edouard Branly<br />
            95200 Sarcelles
          </p>
        </blockquote>

        <h4>Transports depuis Paris</h4>
        <ul>
            <li><img src="/img/rer.png" alt="RER" title="RER" /><img src="/img/rer-d.png" alt="D" title="D" /></li>
        </ul>
        <span style="background-color: #353D92; display: inline-block; padding: 3px 15px; color: #FFFFFF;margin-bottom: 6px;">Garges Sarcelles</span><br />
        <ul>
            <li>
                <img src="/img/bus.png" alt="Bus" title="Bus" />
                <span style="background:#77c695;color:#000;padding:.1em .3em;white-space:nowrap"><b>133</b></span>
                <span style="background:#bb4b9c;color:#fff;padding:.1em .3em;white-space:nowrap"><b>168</b></span>
                <span style="background:#f68f4b;color:#000;padding:.1em .3em;white-space:nowrap"><b>269</b></span>
                <span style="background:#cec92a;color:#000;padding:.1em .3em;white-space:nowrap"><b>368</b></span>
            </li>
            <li>
                <span style="background:#fd3621;color:#ffffff;padding:.1em .3em;white-space:nowrap"><b>Busval d'Oise</b></span>
                <span style="background:#a6ce38;color:#000000;padding: .1em .3em;white-space:nowrap"><b>95.02</b></span>
            </li>
        </ul>
        <span style="background-color: #353D92; display: inline-block; padding: 3px 15px; color: #FFFFFF;margin-bottom: 6px;">Paul Valéry - Édouard Branly</span><br />
        <img src="/img/Itineraires.png" alt="itineraires" />
        <h4>Contacts</h4>
        <p>
            email : nath.noizers@facebook.com <br />
            tel : 0641686775
        </p>

    </div>
    <div class="span4">
        <h2>The Digicode <small><a href="<?php echo $digicode; ?>">Télécharger</a></small></h2>
        <p>Si possible, essayez de rapporter ce digicode en l’imprimant ou en l’enregistrant sur votre appareil mobile.</p>
        <p>Si vous avez un smartphone et le sms, vous n'avez pas besoin d'apporter le digicode.</p>
        <p>Ce digicode nous permettra de vérifier plus simplement les invités et éviter ainsi toute intrusion qui nuira au déroulement de l’évènement.</p>
        <img src="<?php echo $digicode ?>" />
    </div>
</div>


