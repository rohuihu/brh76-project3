<?php $title = 'Playful Plants Project';

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
// $result_entries = exec_sql_query($db, 'SELECT * FROM entries;');
// $records_entries = $result_entries->fetchAll();

// for filtering
$explore_constructive = (bool)trim($_GET['explore-constructive'] ?? NULL);
$explore_sensory = (bool)trim($_GET['explore-sensory'] ?? NULL);
$physical = (bool)trim($_GET['physical-play'] ?? NULL);
$imaginative = (bool)trim($_GET['imaginative-play'] ?? NULL);
$restorative = (bool)trim($_GET['restorative-play'] ?? NULL);
$expressive = (bool)trim($_GET['expressive-play'] ?? NULL);
$play_with_rules = (bool)trim($_GET['play-with-rules'] ?? NULL);
$bio_play = (bool)trim($_GET['bio-play'] ?? NULL);

$shrub = (bool)trim($_GET['shrub'] ?? NULL);
$grass = (bool)trim($_GET['grass'] ?? NULL);
$vine = (bool)trim($_GET['vine'] ?? NULL);
$tree = (bool)trim($_GET['tree'] ?? NULL);
$flower = (bool)trim($_GET['flower'] ?? NULL);
$groundcover = (bool)trim($_GET['groundcover'] ?? NULL);
$other = (bool)trim($_GET['other'] ?? NULL);

// make sticky values
$sticky_explore_constructive = (empty($explore_constructive) ? '' : 'checked');
$sticky_explore_sensory = (empty($explore_sensory) ? '' : 'checked');
$sticky_physical = (empty($physical) ? '' : 'checked');
$sticky_imaginative = (empty($imaginative) ? '' : 'checked');
$sticky_restorative = (empty($restorative) ? '' : 'checked');
$sticky_expressive = (empty($expressive) ? '' : 'checked');
$sticky_play_with_rules = (empty($play_with_rules) ? '' : 'checked');
$sticky_bio_play = (empty($bio_play) ? '' : 'checked');

$sticky_shrub = (empty($shrub) ? '' : 'checked');
$sticky_grass = (empty($grass) ? '' : 'checked');
$sticky_vine = (empty($vine) ? '' : 'checked');
$sticky_tree = (empty($tree) ? '' : 'checked');
$sticky_flower = (empty($flower) ? '' : 'checked');
$sitcky_groundcover = (empty($groundcover) ? '' : 'checked');
$sticky_other = (empty($other) ? '' : 'checked');

$sticky_sort_colloquial_asc = ($sort_by == "Colloquial Name" ? 'checked' : '');
$sticky_sort_genus_asc = ($sort_by == "Scientific Name" ? 'checked' : '');

$sort_by = trim($_GET['sortby'] ?? NULL);

// sorting parts
$sql_select_part = "SELECT * FROM entries";
$sql_where_part = '';
$sql_order_part = '';
$sql_filter_expressions = array();

// filter
$filter_by = array();
if ($explore_constructive) {
  array_push($filter_by, "(explore_constructive = 1)");
}
if ($explore_sensory) {
  array_push($filter_by, "(explore_sensory = 1)");
}
if ($physical) {
  array_push($filter_by, "(physical = 1)");
}
if ($imaginative) {
  array_push($filter_by, "(imaginative = 1)");
}
if ($restorative) {
  array_push($filter_by, "(restorative = 1)");
}
if ($expressive) {
  array_push($filter_by, "(expressive = 1)");
}
if ($play_with_rules) {
  array_push($filter_by, "(play_with_rules = 1)");
}
if ($bio_play) {
  array_push($filter_by, "(bio_play = 1)");
}
if ($shrub) {
  array_push($filter_by, "(class = 0)");
}
if ($grass) {
  array_push($filter_by, "(class = 1)");
}
if ($vine) {
  array_push($filter_by, "(class = 2)");
}
if ($tree) {
  array_push($filter_by, "(class = 3)");
}
if ($flower) {
  array_push($filter_by, "(class = 4)");
}
if ($groundcover) {
  array_push($filter_by, "(class = 5)");
}
if ($other) {
  array_push($filter_by, "(class = 6)");
}

if (count($filter_by) > 0) {
  $where_part = " WHERE " . implode(' OR ', $filter_by);
}

// order by
if ($sort_by == "Colloquial Name") {
  $sql_order_part = " ORDER BY colloquial ASC;";
} else if ($sort_by == "Scientific Name") {
  $sql_order_part = " ORDER BY genus ASC;";
} else {
  $sql_order_part = ";";
}
$sql_query = $sql_select_part . $where_part . $sql_order_part;
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

  <?php include('includes/header.php'); ?>
  <p id="introduction">Welcome to the Playful Plants Project Catalog! Here, you can find a list of plants that can help your child develop!</p>
  <section class="catalog-filter">
    <section class="filter">
      <div class="align-block">
        <form id="filter-form" method="get" action="/" novalidate>
          <h3>Sort By:</h3>
          <div class="radio">
            <input id="sort-colloquial" type="radio" name="sortby" value="Colloquial Name" <?php echo $sticky_sort_colloquial_asc; ?> /><label for="sort-colloquial">Colloquial Name</label>
          </div>
          <div class="radio">
            <input id="sort-genus" type="radio" name="sortby" value="Scientific Name" <?php echo $sticky_sort_genus_asc; ?> /><label for="sort-genus">Scientific Name</label>
          </div>
          <h3>Filter By:</h3>
          <h4>Classification</h4>
          <div class="radio">
            <input type="checkbox" name="shrub" id="shrub" <?php echo htmlspecialchars($sticky_shrub) ?> />
            <label for="shrub">Shrub</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="grass" id="grass" value="grass" <?php echo htmlspecialchars($sticky_grass) ?> />
            <label for="grass">Grass</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="vine" id="vine" value="vine" <?php echo htmlspecialchars($sticky_vine) ?> />
            <label for="vine">Vine</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="tree" id="tree" value="tree" <?php echo htmlspecialchars($sticky_tree) ?> />
            <label for="tree">Tree</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="flower" id="flower" value="flower" <?php echo htmlspecialchars($sticky_flower) ?> />
            <label for="flower">Flower</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="groundcover" id="groundcover" value="groundcover" <?php echo htmlspecialchars($sticky_groundcover) ?> />
            <label for="groundcover">Groundcover</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="other" id="other" value="other" <?php echo htmlspecialchars($sticky_other) ?> />
            <label for="other">Other (Moss, fern, vegetables, etc.)</label>
          </div>
          <h4>Play Type Categorization</h4>
          <div class="radio">
            <input type="checkbox" name="explore-constructive" id="explore-constructive" <?php echo htmlspecialchars($sticky_explore_constructive) ?> />
            <label for="explore-constructive">Exploratory Constructive Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="explore-sensory" id="explore-sensory" <?php echo htmlspecialchars($sticky_explore_sensory) ?> />
            <label for="explore-sensory">Exploratory Sensory Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="physical-play" id="physical-play" <?php echo htmlspecialchars($sticky_physical) ?> />
            <label for="physical-play">Physical Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="imaginative-play" id="imaginative-play" <?php echo htmlspecialchars($sticky_imaginative) ?> />
            <label for="imaginative-play">Imaginative Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="restorative-play" id="restorative-play" <?php echo htmlspecialchars($sticky_restorative) ?> />
            <label for="restorative-play">Restorative Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="expressive-play" id="expressive-play" <?php echo htmlspecialchars($sticky_expressive) ?> />
            <label for="expressive-play">Expressive Play</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="play-with-rules" id="play-with-rules" <?php echo htmlspecialchars($sticky_play_with_rules) ?> />
            <label for="play-with-rules">Play With Rules</label>
          </div>
          <div class="radio">
            <input type="checkbox" name="bio-play" id="bio-play" <?php echo htmlspecialchars($sticky_bio_play) ?> />
            <label for="bio-play">Bio Play</label>
          </div>
          <div class="align-right">
            <input id="filter-submit" name="filter-submit" type="submit" value="Filter" />
          </div>
        </form>
      </div>
      <div class="login">
        <h1><a href="/admin-login">Login as Administrator</a></h1>
      </div>
    </section>
    <!-- All images from the plant photos zip folder except personal artwork -->
    <section class="tiles">
      <?php foreach ($records_entries as $record_entries) { ?>
        <div class="card">
          <a href="/plant-details?<?php echo http_build_query(array(
                                    'id' => $record_entries['id']
                                    // 'colloquial' => $record_entries['colloquial'],
                                    // 'genus' => $record_entries['genus'],
                                    // 'plant_id' => $record_entries['plant_id'],
                                    // 'file_ext' => $record_entries['file_ext'],
                                    // 'class' => $record_entries['class']
                                  )) ?>">
            <div>
              <h1><?php echo htmlspecialchars($record_entries["colloquial"]) ?></h1>
              <h2><?php echo htmlspecialchars($record_entries["genus"]) ?></h2>
              <h3>General Classification:
                <?php if (htmlspecialchars($record_entries["class"] == 0)) { ?>
                  Shrub
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 1)) { ?>
                  Grass
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 2)) { ?>
                  Vine
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 3)) { ?>
                  Tree
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 4)) { ?>
                  Flower
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 5)) { ?>
                  Groundcover
                <?php } ?>
                <?php if (htmlspecialchars($record_entries["class"] == 6)) { ?>
                  Other
                <?php } ?>
              </h3>
              <!-- Image source: Personal artwork by Bella Hu -->
              <img src="/public/uploads/entries/<?php echo htmlspecialchars($record_entries["image_id"] . "." . $record_entries["file_ext"]) ?>" alt="Image of <?php echo htmlspecialchars($record_entries["colloquial"]) ?>">
            </div>
          </a>
        </div>
      <?php } ?>
    </section>
  </section>


</body>

</html>
