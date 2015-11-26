<?php require 'globals.php' ?>

<?php if (strtotime('now') < $GLOBALS['registration-open-date']) { ?>
  <section class="feature feature fa-info-circle">
    <h3>Les inscriptions ne sont pas encore ouvertes</h3>
    <p>
      Merci de revenir plus tard.
    </p>
  </section>
  <?php } ?>

  <?php if (strtotime('now') > $GLOBALS['registration-close-date']) { ?>
    <section class="feature feature fa-info-circle">
      <h3>Les inscriptions sont maintenant fermées</h3>
    </section>
    <?php } ?>

    <?php
    // Check available places from
    // already registered candidates in db

    require 'database.php';
    $db = new Database();

    $db->query("SELECT * FROM bloc_participants WHERE (categorie = :cat1 OR categorie = :cat2) AND payer_id IS NOT NULL");

    $db->bind(':cat1', 'poussin');
    $db->bind(':cat2', 'benjamin');
    $db->resultset();
    $GLOBALS['remaining-places-poussin-benjamin'] = max(0, $GLOBALS['available-places'] - $db->rowCount());

    $db->bind(':cat1', 'minime');
    $db->bind(':cat2', 'cadet');
    $db->resultset();
    $GLOBALS['remaining-places-minime-cadet'] = max(0, $GLOBALS['available-places'] - $db->rowCount());
    ?>

    <?php if ($GLOBALS['remaining-places-poussin-benjamin'] == 0) { ?>
      <section class="feature fa-exclamation-triangle">
        <h3>Attention</h3>
        <p>
          Les inscriptions sont closes pour les catégories <b>Poussin et Benjamin</b>.<br />
          Vous pouvez néanmoins <a href="contact.php">nous contacter</a> pour une
          inscription sur liste d'attente.
        </p>
      </section>
      <?php } ?>

      <?php if ($GLOBALS['remaining-places-minime-cadet'] == 0) { ?>
        <section class="feature fa-exclamation-triangle">
          <h3>Attention</h3>
          <p>
            Les inscriptions sont closes pour les catégories <b>Minime et Cadet</b>.<br />
            Vous pouvez néanmoins <a href="contact.php">nous contacter</a> pour une
            inscription sur liste d'attente.
          </p>
        </section>
        <?php } ?>

        <?php
        $displayForm = (strtotime('now') >= $GLOBALS['registration-open-date']) &&
        (strtotime('now') <= $GLOBALS['registration-close-date']);
        ?>
