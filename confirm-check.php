<?php
// Recheck available places from already registered candidates in db
$available = false;
if ($_SESSION['category'] == 'poussin' || $_SESSION['category'] == 'benjamin')
{
  $db = new Database();
  $db->query("SELECT * FROM bloc_participants WHERE (categorie = :cat1 OR categorie = :cat2) AND payer_id IS NOT NULL");
  $db->bind(':cat1', 'poussin');
  $db->bind(':cat2', 'benjamin');
  $db->resultset();
  $available = ($GLOBALS['available-places'] - $db->rowCount()) > 0;
}
else if ($_SESSION['category'] == 'minime' || $_SESSION['category'] == 'cadet')
{
  $db = new Database();
  $db->query("SELECT * FROM bloc_participants WHERE (categorie = :cat1 OR categorie = :cat2) AND payer_id IS NOT NULL");
  $db->bind(':cat1', 'minime');
  $db->bind(':cat2', 'cadet');
  $db->resultset();
  $available = ($GLOBALS['available-places'] - $db->rowCount()) > 0;
}
?>

<?php if (!$available) { ?>
  <section class="feature fa-exclamation-triangle">
    <h3>Attention</h3>
    <p>
      Les inscriptions sont fermées pour la catégorie demandée.<br />
      Vous pouvez néanmoins <a href="contact.php">nous contacter</a> pour une
      inscription sur liste d'attente.
    </p>
  </section>
  <?php } ?>

  <?php if (empty($_SESSION['lastname'])) { ?>
    <section class="feature fa-exclamation-triangle">
      <h3>Attention</h3>
      <p>
        Vous devez renseigner le nom du participant.
      </p>
    </section>
    <?php } ?>

    <?php if (empty($_SESSION['firstname'])) { ?>
      <section class="feature fa-exclamation-triangle">
        <h3>Attention</h3>
        <p>
          Vous devez renseigner le prénom du participant.
        </p>
      </section>
      <?php } ?>

      <?php if (empty($_SESSION['club'])) { ?>
        <section class="feature fa-exclamation-triangle">
          <h3>Attention</h3>
          <p>
            Vous devez renseigner le club d'appartenance du participant.
          </p>
        </section>
        <?php } ?>

        <?php if (empty($_SESSION['experience'])) { ?>
          <section class="feature fa-exclamation-triangle">
            <h3>Attention</h3>
            <p>
              Vous devez renseigner le niveau du participant.
            </p>
          </section>
          <?php } ?>

          <?php if (empty($_SESSION['mail'])) { ?>
            <section class="feature fa-exclamation-triangle">
              <h3>Attention</h3>
              <p>
                Vous devez renseigner un email de contact valide.
              </p>
            </section>
            <?php } ?>

            <?php if (empty($_SESSION['tel']) || strlen($_SESSION['tel']) != 10) { ?>
              <section class="feature fa-exclamation-triangle">
                <h3>Attention</h3>
                <p>
                  Vous devez renseigner un numéro de téléphone de contact valide.
                </p>
              </section>
              <?php } ?>

              <?php if ($_SESSION['category'] == 'invalid') { ?>
                <section class="feature fa-exclamation-triangle">
                  <h3>Attention</h3>
                  <p>
                    Impossible de déterminer la catégorie du participant à partir de sa date de naissance.
                  </p>
                </section>
                <?php } ?>

                <?php if (!$_SESSION['conditions']) { ?>
                  <section class="feature fa-exclamation-triangle">
                    <h3>Attention</h3>
                    <p>
                      Vous devez accepter le <a href="program.php#rules">règlement de la compétition</a> pour valider votre inscription.
                    </p>
                  </section>
                  <?php } ?>


                  <?php if ($_SESSION['licenceType'] == 'FFME' && strlen($_SESSION['licenceNumber']) != 6) { ?>
                    <section class="feature fa-exclamation-triangle">
                      <h3>Attention</h3>
                      <p>
                        Votre numéro de licence FFME n'a pas le bon format&nbsp: un numéro à 6 chiffres est attendu.
                      </p>
                    </section>
                    <?php } ?>

                    <?php if ($_SESSION['licenceType'] == 'FFCAM' && strlen($_SESSION['licenceNumber']) != 12) { ?>
                      <section class="feature fa-exclamation-triangle">
                        <h3>Attention</h3>
                        <p>
                          Votre numéro de licence FFCAM <b><?php echo $_SESSION['licenceNumber'] ?></b>
                          n'a pas le bon format&nbsp: un numéro à 12 chiffres est attendu.
                        </p>
                      </section>
                      <?php } ?>

                      <?php if ($_SESSION['licenceType'] == 'UNSS' && strlen($_SESSION['licenceNumber']) != 9) { ?>
                        <section class="feature fa-exclamation-triangle">
                          <h3>Attention</h3>
                          <p>
                            Votre numéro de licence UNSS <b><?php echo $_SESSION['licenceNumber'] ?></b>
                            n'a pas le bon format&nbsp: un numéro à 9 chiffres est attendu.
                          </p>
                        </section>
                        <?php } ?>

                        <?php
                        $ok = $available &&
                        !empty($_SESSION['lastname']) &&
                        !empty($_SESSION['firstname']) &&
                        !empty($_SESSION['club']) &&
                        !empty($_SESSION['experience']) &&
                        !empty($_SESSION['mail']) &&
                        !empty($_SESSION['tel']) && strlen($_SESSION['tel']) == 10 &&
                        $_SESSION['category'] != 'invalid' &&
                        $_SESSION['conditions'] &&
                        (($_SESSION['licenceType'] == 'FFME' && strlen($_SESSION['licenceNumber']) == 6) ||
                        ($_SESSION['licenceType'] == 'UNSS' && strlen($_SESSION['licenceNumber']) == 9) ||
                        ($_SESSION['licenceType'] == 'FFCAM' && strlen($_SESSION['licenceNumber']) == 12));
                        ?>

                        <?php if ($ok) { ?>
                          <p>
                            Vous vous apprêtez à finaliser l'inscription du participant
                            <b><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></b>
                            en catégorie <b><?php echo ucwords($_SESSION['category'] . ' ' . $_SESSION['sex_str']) ?></b>.
                          </p>

                          <p>
                            Une fois le paiement effectué, une confirmation vous sera
                            envoyée par email à l'adresse
                            <b><?php echo $_SESSION['mail']?></b>.
                          </p>

                          <p>
                            Merci de bien vérifier les informations saisies avant de
                            procéder au paiement. En cas d'informations incomplètes ou
                            erronées, vous pouvez <a href="registration.php">retourner au formulaire d'inscription</a>
                            pour les modifier.
                          </p>

                          <p style="text-align: center">
                            <a href="<?= $_SESSION['paypal']; ?>" class="button big">Paiement</a>
                          </p>

                          <h3>Informations saisies</h3>
                          <table>

                            <tr>
                              <td>Participant</td>
                              <td><?php echo $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] ?></td>
                            </tr>

                            <tr>
                              <td>Catégorie</td>
                              <td><?php echo ucwords($_SESSION['category'] . ' ' . $_SESSION['sex_str']) . ' (' . $_SESSION['birthday'] . ')' ?></td>
                            </tr>

                            <tr>
                              <td>Club</td>
                              <td><?php echo $_SESSION['club'] . ' ; Licence ' . $_SESSION['licenceType'] . ' ' . $_SESSION['licenceNumber'] ?></td>
                            </tr>

                            <tr>
                              <td>Niveau</td>
                              <td><?php echo $_SESSION['experience'] . ' ' . $_SESSION['comment'] ?></td>
                            </tr>

                            <tr>
                              <td>Contact</td>
                              <td><?php echo $_SESSION['tel'] . ' ; ' . $_SESSION['mail'] ?></td>
                            </tr>

                          </table>

                          <?php } ?>

                          <?php if (!$ok) { ?>
                            <p>
                              Merci de <a href="registration.php">retourner au formulaire</a> afin de corriger ces informations.
                            </p>
                            <?php } ?>
