<!-- Set the title for the webpage -->
<?php $title = 'Playful Plants Project';

// Initialize SQLite database and execute SQL initialization script
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

// Uncomment the following lines if entries are needed
// $result_entries = exec_sql_query($db, 'SELECT * FROM entries;');
// $records_entries = $result_entries->fetchAll();

// Initialize variables for filtering options based on user input
// for filtering
$explore_constructive = (bool)trim($_GET['explore-constructive'] ?? NULL);
$explore_sensory = (bool)trim($_GET['explore-sensory'] ?? NULL);
$physical = (bool)trim($_GET['physical-play'] ?? NULL);
$imaginative = (bool)trim($_GET['imaginative-play'] ?? NULL);
$restorative = (bool)trim($_GET['restorative-play'] ?? NULL);
$expressive = (bool)trim($_GET['expressive-play'] ?? NULL);
$play_with_rules = (bool)trim($_GET['play-with-rules'] ?? NULL);
$bio_play = (bool)trim($_GET['bio-play'] ?? NULL);

// $shrub = (bool)trim($_GET['shrub'] ?? NULL);
// $grass = (bool)trim($_GET['grass'] ?? NULL);
// $vine = (bool)trim($_GET['vine'] ?? NULL);
// $tree = (bool)trim($_GET['tree'] ?? NULL);
// $flower = (bool)trim($_GET['flower'] ?? NULL);
// $groundcover = (bool)trim($_GET['groundcover'] ?? NULL);
// $other = (bool)trim($_GET['other'] ?? NULL);

// Initialize variables for class (shrub, grass, etc.) filtering
$class = trim($_GET['class']);


// Create sticky values for filtering options
// make sticky values
$sticky_explore_constructive = (empty($explore_constructive) ? '' : 'checked');
$sticky_explore_sensory = (empty($explore_sensory) ? '' : 'checked');
$sticky_physical = (empty($physical) ? '' : 'checked');
$sticky_imaginative = (empty($imaginative) ? '' : 'checked');
$sticky_restorative = (empty($restorative) ? '' : 'checked');
$sticky_expressive = (empty($expressive) ? '' : 'checked');
$sticky_play_with_rules = (empty($play_with_rules) ? '' : 'checked');
$sticky_bio_play = (empty($bio_play) ? '' : 'checked');

// Create sticky values for class (shrub, grass, etc.) filtering
$sticky_shrub = ($class == 'shrub' ? 'checked' : '');
$sticky_grass = ($class == 'grass' ? 'checked' : '');
$sticky_vine = ($class == 'vine' ? 'checked' : '');
$sticky_tree = ($class == 'tree' ? 'checked' : '');
$sticky_flower = ($class == 'flower' ? 'checked' : '');
$sticky_groundcover = ($class == 'groundcover' ? 'checked' : '');
$sticky_other = ($class == 'other' ? 'checked' : '');

// Get the sorting criteria from user input
$sort_by = trim($_GET['sortby'] ?? NULL);

// Create sticky values for sorting options
$sticky_sort_colloquial_asc = ($sort_by == "Colloquial Name" ? 'checked' : '');
$sticky_sort_genus_asc = ($sort_by == "Scientific Name" ? 'checked' : '');

// Initialize parts for constructing the SQL query
// sorting parts
$sql_select_part = '';
$sql_where_part = '';
$sql_order_part = '';
$sql_filter_expressions = array();

// Initialize arrays for filtering options
// filter
// $filter_by_play = array();
$filter_by_class = array();
// if ($explore_constructive) {
//   array_push($filter_by_play, "(tags.id = 1)");
// }
// if ($explore_sensory) {
//   array_push($filter_by_play, "(tags.id = 2)");
// }
// if ($physical) {
//   array_push($filter_by_play, "(tags.id = 3)");
// }
// if ($imaginative) {
//   array_push($filter_by_play, "(tags.id = 4)");
// }
// if ($restorative) {
//   array_push($filter_by_play, "(tags.id = 5)");
// }
// if ($expressive) {
//   array_push($filter_by_play, "(tags.id = 6)");
// }
// if ($play_with_rules) {
//   array_push($filter_by_play, "(tags.id = 7)");
// }
// if ($bio_play) {
//   array_push($filter_by_play, "(tags.id = 8)");
// }

// Check class and add corresponding filter expressions
if ($class == 'shrub') {
  array_push($filter_by_class, "(tags.id = 1)");
} elseif ($class == 'grass') {
  array_push($filter_by_class, "(tags.id = 2)");
} elseif ($class == 'vine') {
  array_push($filter_by_class, "(tags.id = 3)");
} elseif ($class == 'tree') {
  array_push($filter_by_class, "(tags.id = 4)");
} elseif ($class == 'flower') {
  array_push($filter_by_class, "(tags.id = 5)");
} elseif ($class == 'groundcover') {
  array_push($filter_by_class, "(tags.id = 6)");
} elseif ($class == 'other') {
  array_push($filter_by_class, "(tags.id = 7)");
}

// Construct SQL parts for filtering
if (count($filter_by_class) > 0) {
  $sql_select_part = "SELECT entries.id AS 'id', entries.colloquial AS 'colloquial',
  entries.genus AS 'genus',
  entries.image_id AS 'image_id',
  entries.file_ext AS 'file_ext',
  tags.id AS 'tags.id',
  tags.tag_name AS 'tags.tag_name',
  entries_tags.entry_id AS 'entries_tags.entry_id',
  entries_tags.tag_id AS 'entries_tags.tag_id'
  FROM
  tags
  INNER JOIN entries_tags ON
  (entries_tags.tag_id = tags.id)
  INNER JOIN entries ON
  (entries_tags.entry_id = entries.id)";
  $sql_where_part = " WHERE " . implode(array_merge($filter_by_class));
} else {
  // Construct SQL parts for the case where no filtering is applied
  // for case where user didn't want to filter by anything
  $sql_select_part = "SELECT entries.id AS 'id', entries.colloquial AS 'colloquial',
  entries.genus AS 'genus',
  entries.image_id AS 'image_id',
  entries.file_ext AS 'file_ext',
  tags.id AS 'tags.id',
  tags.tag_name AS 'tags.tag_name',
  entries_tags.entry_id AS 'entries_tags.entry_id',
  entries_tags.tag_id AS 'entries_tags.tag_id'
  FROM
  tags
  INNER JOIN entries_tags ON
  (entries_tags.tag_id = tags.id)
  INNER JOIN entries ON
  (entries_tags.entry_id = entries.id) WHERE tags.id < 8";
}

// Construct SQL part for ordering results
// order by
if ($sort_by == "Colloquial Name") {
  $sql_order_part = " ORDER BY colloquial ASC;";
} else if ($sort_by == "Scientific Name") {
  $sql_order_part = " ORDER BY genus ASC;";
} else {
  $sql_order_part = ";";
}
// Construct the final SQL query
$sql_query = $sql_select_part . $sql_where_part . $sql_order_part;
$records_entries = exec_sql_query($db, $sql_query)->fetchAll();
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
  <div class="home-body">
    <?php include('includes/header.php'); ?>
    <section class="login">
      <?php if (is_user_logged_in()) { ?>
        <!-- Display navigation for logged-in users -->
        <div class="nav">
          <nav>
            <ul>
              <!-- Links for admin view and logout -->
              <a href="/admin-catalog">
                <li>Back to Administrator View</li>
              </a>
              <a href="<?php echo logout_url(); ?>">
                <li id="nav-logout">Logout Administrator View</li>
              </a>

            </ul>
          </nav>
        </div>
      <?php } ?>

      <!-- Introduction section -->
    </section>
    <p id="introduction">Welcome to the Playful Plants Project Catalog! Here, you can find a list of plants that can help your child develop! Click on each plant to see its growth needs and other details! You can also filter plants as needed.</p>

    <!-- Section for catalog filters -->
    <section class="catalog-filter">
      <!-- Form for sorting and filtering -->
      <section class="filter">
        <div class="align-block">
          <form id="filter-form" method="get" action="/" novalidate>
            <div class="ipad">
              <h3>Sort By:</h3>
              <!-- Options for sorting by colloquial and scientific names -->
              <div class="filter-ipad">
                <div class="radio">
                  <input id="sort-colloquial" type="radio" name="sortby" value="Colloquial Name" <?php echo $sticky_sort_colloquial_asc; ?> /><label for="sort-colloquial">Colloquial Name</label>
                </div>
                <div class="radio">
                  <input id="sort-genus" type="radio" name="sortby" value="Scientific Name" <?php echo $sticky_sort_genus_asc; ?> /><label for="sort-genus">Scientific Name</label>
                </div>
              </div>

              <h3>Filter By:</h3>
              <h4>Classification</h4>
              <!-- Options for filtering by plant classification -->
              <div class="filter-ipad">
                <!-- Each radio button corresponds to a plant classification -->
                <div class="radio">
                  <input type="radio" name="class" id="shrub" value="shrub" <?php echo htmlspecialchars($sticky_shrub) ?> />
                  <label for="shrub">Shrub</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="grass" value="grass" <?php echo htmlspecialchars($sticky_grass) ?> />
                  <label for="grass">Grass</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="vine" value="vine" <?php echo htmlspecialchars($sticky_vine) ?> />
                  <label for="vine">Vine</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="tree" value="tree" <?php echo htmlspecialchars($sticky_tree) ?> />
                  <label for="tree">Tree</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="flower" value="flower" <?php echo htmlspecialchars($sticky_flower) ?> />
                  <label for="flower">Flower</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="groundcover" value="groundcover" <?php echo htmlspecialchars($sticky_groundcover) ?> />
                  <label for="groundcover">Groundcover</label>
                </div>
                <div class="radio">
                  <input type="radio" name="class" id="other" value="other" <?php echo htmlspecialchars($sticky_other) ?> />
                  <label for="other">Other (Moss, fern, vegetables, etc.)</label>
                </div>
              </div>
              <!-- Submit button for the filter form -->
              <div class="align-right">
                <input id="filter-submit" name="filter-submit" type="submit" value="Filter" />
              </div>
            </div>

          </form>
        </div>
        <!-- Display login link if user is not logged in -->
        <?php if (!is_user_logged_in()) { ?>
          <div class="login">
            <h1><a href="/admin-catalog">Login as Administrator</a></h1>
          </div>
        <?php } ?>
      </section>

      <!-- Section for displaying plant tiles -->
      <!-- All images from the plant photos zip folder except personal artwork -->
      <section class="tiles">
        <!-- Loop through plant records and display corresponding tiles -->
        <?php foreach ($records_entries as $record_entries) { ?>
          <div class="card">
            <!-- Link to the plant details page with corresponding ID -->
            <a href="/plant-details?<?php echo http_build_query(array(
                                      'id' => $record_entries['id']
                                    )) ?>">
              <div>
                <!-- Display colloquial and genus names -->
                <h1><?php echo htmlspecialchars($record_entries["colloquial"]) ?></h1>
                <h2><?php echo htmlspecialchars($record_entries["genus"]) ?></h2>

                <!-- Display plant classification based on tag name -->
                <h3>General Classification:
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"]) == 'Shrub') { ?>
                    Shrub
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"]) == 'Grass') { ?>
                    Grass
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"]) == 'Vine') { ?>
                    Vine
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"] == 'Tree')) { ?>
                    Tree
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"] == 'Flower')) { ?>
                    Flower
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"] == 'Groundcovers')) { ?>
                    Groundcover
                  <?php } ?>
                  <?php if (htmlspecialchars($record_entries["tags.tag_name"] == 'Other')) { ?>
                    Other
                  <?php } ?>

                </h3>
                <!-- Display plant image -->
                <!-- Image source: Personal artwork by Bella Hu -->
                <img src="/public/uploads/entries/<?php echo htmlspecialchars($record_entries["image_id"] . "." . $record_entries["file_ext"]) ?>" alt="Image of <?php echo htmlspecialchars($record_entries["colloquial"]) ?>">

              </div>
            </a>
          </div>
        <?php } ?>

        <!-- Display message if no plant records are found -->
        <?php
        if (count($records_entries) == 0) { ?>
          <p>No plant records found.</p>
        <?php } ?>
      </section>
    </section>
  </div>


</body>

</html>
