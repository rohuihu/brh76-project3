<?php
// Initialize SQLite database using 'init_sqlite_db' function
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
// Get entry ID from the URL or set to NULL if not provided
$entry_id = $_GET['id'] ?? NULL;

// Check if entry ID is provided
if ($entry_id) {
  // Fetch records from 'entries' table based on the provided entry ID
  $records = exec_sql_query(
    $db,
    "SELECT * FROM entries WHERE id = :id;",
    array(
      ':id' => $entry_id
    )
  )->fetchAll();

  // Check if records are found
  if (count($records) > 0) {
    // Set details to the first record found
    $details = $records[0];
    // Set the title for the HTML page
    $title = $details['colloquial'] . ' - Playful Plants Project';
  } else {
    // Set details to NULL if no records found
    $details = NULL;
    // Set a default title for unknown plants
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
  <!-- Display colloquial, genus name with HTML escaping -->
  <h1 id="plant-colloquial-name"><?php echo htmlspecialchars($details['colloquial']); ?></h1>
  <h2 id="plant-genus-name"><?php echo htmlspecialchars($details['genus']); ?></h2>

  <!-- Display general classification with a dynamic list of classes -->
  <h3 id="plant-class">General Classification:
    <!-- Fetch tags for the current plant from the database -->
    <?php $classes = exec_sql_query($db, "SELECT
    entries.id AS 'entries.id',
    entries.colloquial AS 'entries.colloquial',
    entries.image_id AS 'image_id',
    entries.file_ext AS 'entries.file_ext',
    tags.id AS 'tags.id',
    tags.tag_name AS 'tags.tag_name',
    entries_tags.entry_id AS 'entries_tags.entry_id',
    entries_tags.tag_id AS 'entries_tags.tag_id'
    FROM
    tags
    INNER JOIN entries_tags ON
    (entries_tags.tag_id = tags.id)
    INNER JOIN entries ON
    (entries_tags.entry_id = entries.id) WHERE tags.id < 8 AND entries.id = :entries_id;", array(
      ':entries_id' => $details['id']
    ));
    // Iterate through classes and display them with HTML escaping
    foreach ($classes as $class) {
      echo htmlspecialchars($class['tags.tag_name']);
    } ?>
  </h3>


  <div id="details-flex">
    <!-- Display plant image with HTML escaping -->
    <img src="/public/uploads/entries/<?php echo htmlspecialchars($details['image_id']) . "." .  htmlspecialchars($details['file_ext']); ?>" alt="<?php echo htmlspecialchars($details['colloquial']) ?> picture">
    <div>
      <div>
        <h3>General Care:</h3>
        <!-- Display general care details with a dynamic list of care tags -->
        <ul>
          <?php $tags = exec_sql_query($db, "SELECT
    entries.id AS 'entries.id',
    entries.colloquial AS 'entries.colloquial',
    entries.image_id AS 'image_id',
    entries.file_ext AS 'entries.file_ext',
    tags.id AS 'tags.id',
    tags.tag_name AS 'tags.tag_name',
    entries_tags.entry_id AS 'entries_tags.entry_id',
    entries_tags.tag_id AS 'entries_tags.tag_id'
    FROM
    tags
    INNER JOIN entries_tags ON
    (entries_tags.tag_id = tags.id)
    INNER JOIN entries ON
    (entries_tags.entry_id = entries.id) WHERE tags.id > 7 AND entries.id = :entries_id;", array(
            ':entries_id' => $details['id']
          ));
          // Iterate through care tags and display them with HTML escaping
          foreach ($tags as $tag) { ?>
            <li><?php echo htmlspecialchars($tag['tags.tag_name']); ?></li>
          <?php } ?>

        </ul>
      </div>
      <div>
        <!-- Display hardiness zone details with a dynamic value -->
        <!-- Hardiness zone definition citation: https://www.fs.fed.us/wildflowers/Native_Plant_Materials/Native_Gardening/hardinesszones.shtml -->
        <h3>Hardiness Zone: </h3>
        <p>This plant has a hardiness zone of <?php echo htmlspecialchars($details['hardiness']) ?>. This range is the standard by which gardeners and growers can determine which plants are most likely to thrive at a location.</p>
      </div>
    </div>
  </div>

</body>
<footer>
  <a href="https://www.fs.fed.us/wildflowers/Native_Plant_Materials/Native_Gardening/hardinesszones.shtml">Hardiness zone definition source</a>
</footer>

</html>
