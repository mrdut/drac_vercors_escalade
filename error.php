<?php
session_start();
include("header.php");
?>

<section id="main" class="wrapper style1">
  <header class="major">
    <h2>Don't panic !</h2>
  </header>
  <div class="container">

    <!-- Content -->
    <section id="content">

      <!-- Text -->
      <section class="feature fa-exclamation-triangle">
        <p>
          <?php
          if (!empty($_SESSION['user-error-str']))
          {
            echo $_SESSION['user-error-str'];
          }
          else
          {
            echo "La page demandée n'est pas disponible.";
          }
          ?>
        </p>

        <p>
          <a href="index.php" class="button big">Retourner au site</a>
        </p>

      </section>

    </section>

  </div>
</section>

<?php include("footer.php"); ?>
