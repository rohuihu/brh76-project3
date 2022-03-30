<?php $title = 'Playful Plants Project';
// open database
$db = open_sqlite_db('tmp/site.sqlite');
// $result = exec_sql_query($db, 'SELECT * FROM plants;');
// $records = $result->fetchAll();

// confirmation and validity booleans
$show_confirmation = False;
$show_form = True;
$form_valid = False;
$record_inserted = False;
$plant_id_not_unique = False;
$colloquial_not_unique = False;
$genus_not_unique = False;

// values
$colloquial = '';
$genus = '';
$plant_id = '';
$explore_constructive = '';
$explore_sensory = '';
$physical = '';
$imaginative = '';
$restorative = '';
$expressive = '';
$play_with_rules = '';
$bio_play = '';
$nooks = '';
$loose_parts = '';
$climb_swing = '';
$maze = '';
$unique = '';
$sort_by = '';

$explore_constructive_1 = '';
$explore_sensory_1 = '';
$physical_1 = '';
$imaginative_1 = '';
$restorative_1 = '';
$expressive_1 = '';
$play_with_rules_1 = '';
$bio_play_1 = '';
$nooks_1 = '';
$loose_parts_1 = '';
$climb_swing_1 = '';
$maze_1 = '';
$unique_1 = '';

// sticky values
$sticky_colloquial = '';
$sticky_genus = '';
$sticky_plant_id = '';
$sticky_explore_constructive = '';
$sticky_explore_sensory = '';
$sticky_physical = '';
$sticky_imaginative = '';
$sticky_restorative = '';
$sticky_expressive = '';
$sticky_play_with_rules = '';
$sticky_bio_play = '';
$sticky_nooks = '';
$sticky_loose_parts = '';
$sticky_climb_swing = '';
$sticky_maze = '';
$sticky_unique = '';
$sticky_sort_colloquial_asc = '';
$sticky_sort_genus_asc = '';
$sticky_sort_id_asc = '';

$sticky_explore_constructive_1 = '';
$sticky_explore_sensory_1 = '';
$sticky_physical_1 = '';
$sticky_imaginative_1 = '';
$sticky_restorative_1 = '';
$sticky_expressive_1 = '';
$sticky_play_with_rules_1 = '';
$sticky_bio_play_1 = '';
$sticky_nooks_1 = '';
$sticky_loose_parts_1 = '';
$sticky_climb_swing_1 = '';
$sticky_maze_1 = '';
$sticky_unique_1 = '';

// feedback classes
$colloquial_feedback_class = 'hidden';
$genus_feedback_class = 'hidden';
$plant_id_feedback_class = 'hidden';
$play_type_feedback_class = 'hidden';
$play_opportunities_feedback_class = 'hidden';

// for adding a plant
if (isset($_POST['add-plant'])) {
  $colloquial = trim($_POST['colloquial-name']);
  $genus = trim($_POST['scientific-name']);
  $plant_id = trim($_POST['plant-id']);
  $explore_constructive_1 = trim($_POST['explore-constructive-1']);
  $explore_sensory_1 = trim($_POST['explore-sensory-1']);
  $physical_1 = trim($_POST['physical-play-1']);
  $imaginative_1 = trim($_POST['imaginative-play-1']);
  $restorative_1 = trim($_POST['restorative-play-1']);
  $expressive_1 = trim($_POST['expressive-play-1']);
  $play_with_rules_1 = trim($_POST['play-with-rules-1']);
  $bio_play_1 = trim($_POST['bio-play-1']);
  $nooks_1 = trim($_POST['nooks-1']);
  $loose_parts_1 = trim($_POST['props-1']);
  $climb_swing_1 = trim($_POST['climb-swing-1']);
  $maze_1 = trim($_POST['mazes-1']);
  $unique_1 = trim($_POST['unique-1']);

  $form_valid = True;

  if (empty($colloquial)) {
    $form_valid = False;
    $colloquial_feedback_class = '';
  } else {
    $records = exec_sql_query(
      $db,
      "SELECT * FROM plants WHERE (colloquial = :colloquial);",
      array(
        ':colloquial' => $colloquial
      )
    )->fetchAll();
    if (count($records) > 0) {
      $form_valid = False;
      $colloquial_not_unique = True;
    }
  }
  if (empty($genus)) {
    $form_valid = False;
    $genus_feedback_class = '';
  } else {
    $records = exec_sql_query(
      $db,
      "SELECT * FROM plants WHERE (genus = :genus);",
      array(
        ':genus' => $genus
      )
    )->fetchAll();
    if (count($records) > 0) {
      $form_valid = False;
      $genus_not_unique = True;
    }
  }
  if (empty($plant_id)) {
    $form_valid = False;
    $plant_id_feedback_class = '';
  } else {
    $records = exec_sql_query(
      $db,
      "SELECT * FROM plants WHERE (plant_id = :plant_id);",
      array(
        ':plant_id' => $plant_id
      )
    )->fetchAll();
    if (count($records) > 0) {
      $form_valid = False;
      $plant_id_not_unique = True;
    }
  }

  // At least one check box checked:
  if (empty($explore_constructive_1) && empty($explore_sensory_1) && empty($physical_1) && empty($imaginative_1) && empty($restorative_1) && empty($expressive_1) && empty($play_with_rules_1) && empty($bio_play_1)) {
    $form_valid = False;
    $play_type_feedback_class = '';
  }
  if (empty($nooks_1) && empty($loose_parts_1) && empty($climb_swing_1) && empty($maze_1) && empty($unique_1)) {
    $form_valid = False;
    $play_opportunities_feedback_class = '';
  }


  if ($form_valid) {
    $show_confirmation = True;
    $show_form = False;
    $result = exec_sql_query(
      $db,
      "INSERT INTO plants (colloquial, genus, plant_id, explore_constructive, explore_sensory, physical, imaginative, restorative, expressive, play_with_rules, bio_play, nooks, loose_parts, climb_swing, maze, unique_opp) VALUES (:colloquial, :genus, :plant_id, :explore_constructive, :explore_sensory, :physical, :imaginative, :restorative, :expressive, :play_with_rules, :bio_play, :nooks, :loose_parts, :climb_swing, :maze, :unique_opp);",
      array(
        ':colloquial' => $colloquial,
        ':genus' => $genus,
        'plant_id' => $plant_id,
        ':explore_constructive' => (int)((bool)$explore_constructive_1),
        ':explore_sensory' => (int)((bool)$explore_sensory_1),
        ':physical' => (int)((bool)$physical_1),
        ':imaginative' => (int)((bool)$imaginative_1),
        ':restorative' => (int)((bool)$restorative_1),
        ':expressive' => (int)((bool)$expressive_1),
        ':play_with_rules' => (int)((bool)$play_with_rules_1),
        ':bio_play' => (int)((bool)$bio_play_1),
        ':nooks' => (int)((bool)$nooks_1),
        ':loose_parts' => (int)((bool)$loose_parts_1),
        ':climb_swing' => (int)((bool)$climb_swing_1),
        ':maze' => (int)((bool)$maze_1),
        ':unique_opp' => (int)((bool)$unique_1)
      )
    );
    if ($result) {
      $record_inserted = True;
    }
    // submit form, post confirmation message in place of page
  } else {
    // make sticky values
    $sticky_colloquial = $colloquial;
    $sticky_genus = $genus;
    $sticky_plant_id = $plant_id;
    $sticky_explore_constructive_1 = (empty($explore_constructive_1) ? '' : 'checked');
    $sticky_explore_sensory_1 = (empty($explore_sensory_1) ? '' : 'checked');
    $sticky_physical_1 = (empty($physical_1) ? '' : 'checked');
    $sticky_imaginative_1 = (empty($imaginative_1) ? '' : 'checked');
    $sticky_restorative_1 = (empty($restorative_1) ? '' : 'checked');
    $sticky_expressive_1 = (empty($expressive_1) ? '' : 'checked');
    $sticky_play_with_rules_1 = (empty($play_with_rules_1) ? '' : 'checked');
    $sticky_bio_play_1 = (empty($bio_play_1) ? '' : 'checked');
    $sticky_nooks_1 = (empty($nooks_1) ? '' : 'checked');
    $sticky_loose_parts_1 = (empty($loose_parts_1) ? '' : 'checked');
    $sticky_climb_swing_1 = (empty($climb_swing_1) ? '' : 'checked');
    $sticky_maze_1 = (empty($maze_1) ? '' : 'checked');
    $sticky_unique_1 = (empty($unique_1) ? '' : 'checked');
  }
}

// filter queries
$sql_select_part = "SELECT * FROM plants";
$sql_where_part = '';
$sql_order_part = '';
$sql_filter_expressions = array();

// for filtering
$explore_constructive = (bool)trim($_GET['explore-constructive'] ?? NULL);
$explore_sensory = (bool)trim($_GET['explore-sensory'] ?? NULL);
$physical = (bool)trim($_GET['physical-play'] ?? NULL);
$imaginative = (bool)trim($_GET['imaginative-play'] ?? NULL);
$restorative = (bool)trim($_GET['restorative-play'] ?? NULL);
$expressive = (bool)trim($_GET['expressive-play'] ?? NULL);
$play_with_rules = (bool)trim($_GET['play-with-rules'] ?? NULL);
$bio_play = (bool)trim($_GET['bio-play'] ?? NULL);
$nooks = (bool)trim($_GET['nooks'] ?? NULL);
$loose_parts = (bool)trim($_GET['props'] ?? NULL);
$climb_swing = (bool)trim($_GET['climb-swing'] ?? NULL);
$maze = (bool)trim($_GET['mazes'] ?? NULL);
$unique = (bool)trim($_GET['unique'] ?? NULL);
$sort_by = trim($_GET['sortby'] ?? NULL);


// make sticky values
$sticky_explore_constructive = (empty($explore_constructive) ? '' : 'checked');
$sticky_explore_sensory = (empty($explore_sensory) ? '' : 'checked');
$sticky_physical = (empty($physical) ? '' : 'checked');
$sticky_imaginative = (empty($imaginative) ? '' : 'checked');
$sticky_restorative = (empty($restorative) ? '' : 'checked');
$sticky_expressive = (empty($expressive) ? '' : 'checked');
$sticky_play_with_rules = (empty($play_with_rules) ? '' : 'checked');
$sticky_bio_play = (empty($bio_play) ? '' : 'checked');
$sticky_nooks = (empty($nooks) ? '' : 'checked');
$sticky_loose_parts = (empty($loose_parts) ? '' : 'checked');
$sticky_climb_swing = (empty($climb_swing) ? '' : 'checked');
$sticky_maze = (empty($maze) ? '' : 'checked');
$sticky_unique = (empty($unique) ? '' : 'checked');
$sticky_sort_colloquial_asc = ($sort_by == "Colloquial Name" ? 'checked' : '');
$sticky_sort_genus_asc = ($sort_by == "Scientific Name" ? 'checked' : '');
$sticky_sort_id_asc = ($sort_by == "Plant ID" ? 'checked' : '');


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
if ($nooks) {
  array_push($filter_by, "(nooks = 1)");
}
if ($loose_parts) {
  array_push($filter_by, "(loose_parts = 1)");
}
if ($climb_swing) {
  array_push($filter_by, "(climb_swing = 1)");
}
if ($maze) {
  array_push($filter_by, "(maze = 1)");
}
if ($unique) {
  array_push($filter_by, "(unique = 1)");
}

if (count($filter_by) > 0) {
  $where_part = " WHERE " . implode(' OR ', $filter_by);
}

// order by
if ($sort_by == "Colloquial Name") {
  $sql_order_part = " ORDER BY colloquial ASC;";
} else if ($sort_by == "Scientific Name") {
  $sql_order_part = " ORDER BY genus ASC;";
} else if ($sort_by == "Plant ID") {
  $sql_order_part = " ORDER BY plant_id ASC;";
} else {
  $sql_order_part = ";";
}
$sql_query = $sql_select_part . $where_part . $sql_order_part;
$records = exec_sql_query($db, $sql_query)->fetchAll();

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
  <p id="introduction">Welcome to the Playful Plants Project Catalog! Here, you can find a list of plants that are being used in the project so far. You can sort, filter, or add your own plant to the catalog.</p>
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
          <div class="radio">
            <input id="sort-id" type="radio" name="sortby" value="Plant ID" <?php echo $sticky_sort_id_asc; ?> /><label for="sort-id">Plant ID</label>
          </div>
          <h3>Filter By:</h3>
          <div>
            <p>Play Type Categorization:</p>
          </div>
          <div class="form-label">
            <input type="checkbox" name="explore-constructive" id="explore-constructive" <?php echo htmlspecialchars($sticky_explore_constructive) ?> />
            <label for="explore-constructive">Exploratory Constructive Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="explore-sensory" id="explore-sensory" <?php echo htmlspecialchars($sticky_explore_sensory) ?> />
            <label for="explore-sensory">Exploratory Sensory Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="physical-play" id="physical-play" <?php echo htmlspecialchars($sticky_physical) ?> />
            <label for="physical-play">Physical Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="imaginative-play" id="imaginative-play" <?php echo htmlspecialchars($sticky_imaginative) ?> />
            <label for="imaginative-play">Imaginative Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="restorative-play" id="restorative-play" <?php echo htmlspecialchars($sticky_restorative) ?> />
            <label for="restorative-play">Restorative Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="expressive-play" id="expressive-play" <?php echo htmlspecialchars($sticky_expressive) ?> />
            <label for="expressive-play">Expressive Play</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="play-with-rules" id="play-with-rules" <?php echo htmlspecialchars($sticky_play_with_rules) ?> />
            <label for="play-with-rules">Play With Rules</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="bio-play" id="bio-play" <?php echo htmlspecialchars($sticky_bio_play) ?> />
            <label for="bio-play">Bio Play</label>
          </div>
          <div>
            <p>Play Opportunities:</p>
          </div>
          <div class="form-label">
            <input type="checkbox" name="nooks" id="nooks" <?php echo htmlspecialchars($sticky_nooks) ?> />
            <label for="nooks">Nooks or Secret Spaces</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="props" id="props" <?php echo htmlspecialchars($sticky_loose_parts) ?> />
            <label for="props">Loose Parts/Play Props</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="climb-swing" id="climb-swing" <?php echo htmlspecialchars($sticky_climb_swing) ?> />
            <label for="climb-swing">Climbing and Swinging</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="mazes" id="mazes" <?php echo htmlspecialchars($sticky_maze) ?> />
            <label for="mazes">Mazes/Labyrinths/Spirals</label>
          </div>
          <div class="form-label">
            <input type="checkbox" name="unique" id="unique" <?php echo htmlspecialchars($sticky_unique) ?> />
            <label for="unique">Evocative or Unique Elements</label>
          </div>
          <div class="align-right">
            <input id="filter-submit" name="filter-submit" type="submit" value="Filter" />
          </div>
        </form>
      </div>

    </section>
  </section>

  <section class="catalog">
    <div class="align-block">
      <h3>Catalog</h3>
      <table>
        <tr>
          <th>Name</th>
          <th>ID</th>
          <th>Play Type Categorization</th>
          <th>Play Opportunities</th>
        </tr>

        <?php foreach ($records as $record) { ?>
          <tr>
            <!-- add plant names -->
            <td>
              <ul>
                <li>
                  <?php echo htmlspecialchars($record["colloquial"]) ?>
                </li>
                <li id="scientific">
                  <?php echo htmlspecialchars($record["genus"]) ?>
                </li>
              </ul>
            </td>

            <!-- add plant id -->
            <td>
              <?php echo htmlspecialchars($record["plant_id"]) ?>
            </td>

            <!-- add play type categorization -->
            <td>
              <ul>
                <?php if ($record["explore_constructive"] == 1) { ?>
                  <li>
                    Exploratory Constructive Play
                  </li>
                <?php } ?>
                <?php if ($record["explore_sensory"] == 1) { ?>
                  <li>
                    Exploratory Sensory Play
                  </li>
                <?php } ?>
                <?php if ($record["physical"] == 1) { ?>
                  <li>
                    Physical Play
                  </li>
                <?php } ?>
                <?php if ($record["imaginative"] == 1) { ?>
                  <li>
                    Imaginative Play
                  </li>
                <?php } ?>
                <?php if ($record["restorative"] == 1) { ?>
                  <li>
                    Restorative Play
                  </li>
                <?php } ?>
                <?php if ($record["expressive"] == 1) { ?>
                  <li>
                    Expressive Play
                  </li>
                <?php } ?>
                <?php if ($record["play_with_rules"] == 1) { ?>
                  <li>
                    Play With Rules
                  </li>
                <?php } ?>
                <?php if ($record["bio_play"] == 1) { ?>
                  <li>
                    Bio Play
                  </li>
                <?php } ?>
              </ul>
            </td>

            <!-- add play opportunities -->
            <td>
              <ul>
                <?php if ($record["nooks"] == 1) { ?>
                  <li>
                    Nooks or Secret Spaces
                  </li>
                <?php } ?>
                <?php if ($record["loose_parts"] == 1) { ?>
                  <li>
                    Loose Parts/Play Props
                  </li>
                <?php } ?>
                <?php if ($record["climb_swing"] == 1) { ?>
                  <li>
                    Climbing or Swinging
                  </li>
                <?php } ?>
                <?php if ($record["maze"] == 1) { ?>
                  <li>
                    Mazes/Labyrinths/Spirals
                  </li>
                <?php } ?>
                <?php if ($record["unique_opp"] == 1) { ?>
                  <li>
                    Evocative or Unique Elements
                  </li>
                <?php } ?>
              </ul>
            </td>

          </tr>
        <?php } ?>
      </table>
    </div>
  </section>


  <?php if ($show_form) { ?>
    <div id="add-plant">
      <h3>Add a Plant!</h3>
      <p id="directions">Fill out the form below to add a plant to the database.</p>
      <form id="add-form" method="post" action="/" novalidate>

        <div id="feedback-colloquial" class="feedback <?php echo $colloquial_feedback_class; ?>">Please enter the plant's colloquial name.</div>
        <?php if ($colloquial_not_unique) { ?>
          <p class="feedback">The colloquial name &quot;<?php echo htmlspecialchars($colloquial); ?>&quot; already exists in the catalog. Please specify a different colloquial name.</p>
        <?php } ?>
        <div class="form-label">
          <label for="colloquial-name">Plant name (colloquial):</label>
          <input type="text" name="colloquial-name" id="colloquial-name" value="<?php echo htmlspecialchars($sticky_colloquial); ?>" />
        </div>

        <div id="feedback-genus" class="feedback <?php echo $genus_feedback_class; ?>">Please enter the plant's scientific name.</div>
        <?php if ($genus_not_unique) { ?>
          <p class="feedback">The scientific name &quot;<?php echo htmlspecialchars($genus); ?>&quot; already exists in the catalog. Please specify a different scientific name.</p>
        <?php } ?>
        <div class="form-label">
          <label for="scientific-name">Plant name (scientific):</label>
          <input type="text" name="scientific-name" id="scientific-name" value="<?php echo htmlspecialchars($sticky_genus); ?>" />
        </div>

        <div id="feedback-id" class="feedback <?php echo $plant_id_feedback_class; ?>">Please enter the plant's ID.</div>
        <?php if ($plant_id_not_unique) { ?>
          <p class="feedback">The Plant ID &quot;<?php echo htmlspecialchars($plant_id); ?>&quot; already exists in the catalog. Please specify a different plant ID.</p>
        <?php } ?>
        <div class="form-label">
          <label for="plant-id">Plant ID:</label>
          <input type="text" name="plant-id" id="plant-id" value="<?php echo htmlspecialchars($sticky_plant_id); ?>" />
        </div>

        <div>
          <p>What types of play does the plant support? Check the boxes below:</p>
        </div>

        <div id="feedback-play-type" class="feedback <?php echo $play_type_feedback_class; ?>">Please select at least one play type categorization.</div>
        <div class="form-label">
          <input type="checkbox" name="explore-constructive-1" id="explore-constructive-1" <?php echo htmlspecialchars($sticky_explore_constructive_1); ?> />
          <label for="explore-constructive-1">Exploratory Constructive Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="explore-sensory-1" id="explore-sensory-1" <?php echo htmlspecialchars($sticky_explore_sensory_1); ?> />
          <label for="explore-sensory-1">Exploratory Sensory Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="physical-play-1" id="physical-play-1" <?php echo htmlspecialchars($sticky_physical_1); ?> />
          <label for="physical-play-1">Physical Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="imaginative-play-1" id="imaginative-play-1" <?php echo htmlspecialchars($sticky_imaginative_1); ?> />
          <label for="imaginative-play-1">Imaginative Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="restorative-play-1" id="restorative-play-1" <?php echo htmlspecialchars($sticky_restorative_1); ?> />
          <label for="restorative-play-1">Restorative Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="expressive-play-1" id="expressive-play-1" <?php echo htmlspecialchars($sticky_expressive_1); ?> />
          <label for="expressive-play-1">Expressive Play</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="play-with-rules-1" id="play-with-rules-1" <?php echo htmlspecialchars($sticky_play_with_rules_1); ?> />
          <label for="play-with-rules-1">Play With Rules</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="bio-play-1" id="bio-play-1" <?php echo htmlspecialchars($sticky_bio_play_1); ?> />
          <label for="bio-play-1">Bio Play</label>
        </div>

        <div>
          <p>What kind of opportunities for play does the plant promote? Check the boxes below:</p>
        </div>

        <div id="feedback-play-opportunities" class="feedback <?php echo $play_opportunities_feedback_class; ?>">Please select at least one way the plant provides play opportunities.</div>
        <div class="form-label">
          <input type="checkbox" name="nooks-1" id="nooks-1" <?php echo htmlspecialchars($sticky_nooks_1); ?> />
          <label for="nooks-1">Nooks or Secret Spaces</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="props-1" id="props-1" <?php echo htmlspecialchars($sticky_loose_parts_1); ?> />
          <label for="props-1">Loose Parts/Play Props</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="climb-swing-1" id="climb-swing-1" <?php echo htmlspecialchars($sticky_climb_swing_1); ?> />
          <label for="climb-swing-1">Climbing and Swinging</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="mazes-1" id="mazes-1" <?php echo htmlspecialchars($sticky_maze_1); ?> />
          <label for="mazes-1">Mazes/Labyrinths/Spirals</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="unique-1" id="unique-1" <?php echo htmlspecialchars($sticky_unique_1); ?> />
          <label for="unique-1">Evocative or Unique Elements</label>
        </div>
        <div class="align-right">
          <input id="add-submit" type="submit" name="add-plant" value="Add Plant to Catalog" />
        </div>
      </form>
    </div>
  <?php }
  if ($show_confirmation) { ?>
    <div class="add-confirmation">
      <p>The plant, <?php echo htmlspecialchars($colloquial); ?>, has been added to the catalog. <a href="/">Add another plant</a>!</p>
    </div>
  <?php } ?>
</body>

</html>
