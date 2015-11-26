<?php include("header.php"); ?>

<?php
// Check available places from
// already registered candidates in db

require 'database.php';
$db = new Database();

$db->query("SELECT * FROM bloc_participants WHERE payer_id IS NOT NULL");
$db->resultset();

$db->bind(':cat1', 'minime');
$db->bind(':cat2', 'cadet');
$rows = $db->resultset();
?>

<section id="main" class="wrapper style1">
  <header class="major">
    <h2>Liste des participants inscrits</h2>
  </header>
  <div class="container">

    <!-- Content -->
    <section id="content">

      <!-- Text -->
      <script src="js/sort-table.js"></script>

      <?php
      echo "<table class=\"sortable\">";
      echo "<tr>";
      echo "<th>Nom</th>";
      echo "<th>Prénom</th>";
      echo "<th>Club</th>";
      echo "<th>Catégorie</th>";
      echo "</tr>";

      foreach ($rows as $row)
      {
        $sex       = ($row['sexe'] == 'M') ? 'Garçon' : 'Fille';
        $lastname  = strtoupper($row['nom']);
        $firstname = ucwords(strtolower($row['prenom']));
        $category  = ucfirst($row['categorie']) . " " . $sex;
        $club      = strtoupper($row['club']);
        echo "<tr>";
        echo "<td>" . $lastname  . "</td>";
        echo "<td>" . $firstname . "</td>";
        echo "<td>" . $club      . "</td>";
        echo "<td>" . $category  . "</td>";
        echo "</tr>";
      }

      echo "</table>";
      ?>

    </section>
  </div>
</section>

<?php include("footer.php"); ?>
