<?php

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$entry_id = $_GET['id'] ?? NULL;

if ($entry_id) {
  $records = exec_sql_query(
    $db,
    "SELECT * FROM entries WHERE id = :id;",
    array(':id' => $entry_id)
  )->fetchAll();

  if (count($records) > 0) {
    $details = $records[0];

    $title = $details['colloquial'] . ' - Playful Plants Project';
  } else {
    $details = NULL;

    $title = 'Unknown Plant - Playful Plants Project';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />
  <title><?php echo $title ?></title>
</head>

<body>
  <h1 id="plant-colloquial-name"><?php echo htmlspecialchars($details['colloquial']); ?></h1>
  <h2 id="plant-genus-name"><?php echo htmlspecialchars($details['genus']); ?></h2>
  <h3 id="plant-class">General Classification:
    <?php if (htmlspecialchars($details['class'] == 0)) { ?>
      Shrub
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 1)) { ?>
      Grass
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 2)) { ?>
      Vine
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 3)) { ?>
      Tree
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 4)) { ?>
      Flower
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 5)) { ?>
      Groundcover
    <?php } ?>

    <?php if (htmlspecialchars($details['class'] == 6)) { ?>
      Other
    <?php } ?>
  </h3>


  <div id="details-flex">
    <img src="/public/uploads/entries/<?php echo htmlspecialchars($details['image_id']) . "." .  htmlspecialchars($details['file_ext']); ?>" alt="<?php echo htmlspecialchars($details['colloquial']) ?> picture">
    <div>
      <h3>General Care:</h3>
      <ul>
        <?php if (htmlspecialchars($details['perennial']) == 1) { ?>
          <li>Perennial</li>
        <?php } ?>
        <?php if (htmlspecialchars($details['annual']) == 1) { ?>
          <li>Annual</li>
        <?php } ?>
        <?php if (htmlspecialchars($details['full_sun']) == 1) { ?>
          <li>Full sun</li>
        <?php } ?>
        <?php if (htmlspecialchars($details['partial_shade']) == 1) { ?>
          <li>Partial shade</li>
        <?php } ?>
        <?php if (htmlspecialchars($details['full_shade']) == 1) { ?>
          <li>Full shade</li>
        <?php } ?>
      </ul>
    </div>
  </div>

</body>

</html>
