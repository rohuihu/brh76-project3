<?php $title = 'Edit - Playful Plants Project';

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

if (is_user_logged_in() && $is_admin) {

  // confirmation and validity booleans
  $show_confirmation = False;
  $show_form = True;
  $form_valid = False;
  $record_updated = False;

  // values
  $colloquial = '';
  $genus = '';
  $plant_id = '';
  $hardiness = '';
  $explore_constructive_1 = '';
  $explore_sensory_1 = '';
  $physical_1 = '';
  $imaginative_1 = '';
  $restorative_1 = '';
  $expressive_1 = '';
  $play_with_rules_1 = '';
  $bio_play_1 = '';
  $class = '';
  $upload_filename = "0";
  $upload_ext = "jpg";
  $perennial = '';
  $annual = '';
  $full_sun = '';
  $partial_shade = '';
  $full_shade = '';

  $plant_record_colloquial = $_GET['edit'] ?? NULL;
  $update_plant = $_POST['update-id'] ?? NULL;

  if ($update_plant) {
    $records = exec_sql_query(
      $db,
      "SELECT * FROM entries WHERE (id = :id);",
      array(
        ':id' => $update_plant
      )
    )->fetchAll();
    // plant exists in db
    if (count($records) > 0) {
      $record = $records[0];
    }
  } elseif ($plant_record_colloquial) {
    $plant_record_colloquial = trim($plant_record_colloquial);

    $records = exec_sql_query(
      $db,
      "SELECT * FROM entries WHERE (colloquial = :colloquial);",
      array(
        ':colloquial' => $plant_record_colloquial
      )
    )->fetchAll();
    // plant exists in db
    if (count($records) > 0) {
      $record = $records[0];
    }
  }

  if ($record) {
    $id = $record['id'];
    $colloquial = $record['colloquial'];
    $genus = $record['genus'];
    $plant_id = $record['plant_id'];
    $hardiness = $record['hardiness'];

    $explore_constructive_1 = $record['explore_constructive'] == 1 ? 'checked' : '';
    $explore_sensory_1 = $record['explore_sensory'] == 1 ? 'checked' : '';
    $physical_1 = $record['physical'] == 1 ? 'checked' : '';
    $imaginative_1 = $record['imaginative'] == 1 ? 'checked' : '';
    $restorative_1 = $record['restorative'] == 1 ? 'checked' : '';
    $expressive_1 = $record['expressive'] == 1 ? 'checked' : '';
    $play_with_rules_1 = $record['play_with_rules'] == 1 ? 'checked' : '';
    $bio_play_1 = $record['bio_play'] == 1 ? 'checked' : '';

    $record_tags = exec_sql_query($db, "SELECT
  entries.id AS 'entries.id',
  entries.colloquial AS 'entries.colloquial',
  tags.id AS 'tags.id',
  tags.tag_name AS 'tags.tag_name',
  entries_tags.entry_id AS 'entries_tags.entry_id',
  entries_tags.tag_id AS 'entries_tags.tag_id'
  FROM
  tags
  INNER JOIN entries_tags ON
  (entries_tags.tag_id = tags.id)
  INNER JOIN entries ON
  (entries_tags.entry_id = entries.id) WHERE tags.id > 7 AND entries.id = :id;", array(
      ':id' => $id
    ));

    $record_classes = exec_sql_query($db, "SELECT
  entries.id AS 'entries.id',
  entries.colloquial AS 'entries.colloquial',
  tags.id AS 'tags.id',
  tags.tag_name AS 'tags.tag_name',
  entries_tags.entry_id AS 'entries_tags.entry_id',
  entries_tags.tag_id AS 'entries_tags.tag_id'
  FROM
  tags
  INNER JOIN entries_tags ON
  (entries_tags.tag_id = tags.id)
  INNER JOIN entries ON
  (entries_tags.entry_id = entries.id) WHERE tags.id < 8 AND entries.id = :id;", array(
      ':id' => $id
    ));
    foreach ($record_classes as $record_class) {
      $class = $record_class['tags.tag_name'];
    }

    foreach ($record_tags as $record_tag) {
      if ($record_tag['tags.id'] == 8) {
        $perennial = 'checked';
      }
      if ($record_tag['tags.id'] == 9) {
        $annual = 'checked';
      }
      if ($record_tag['tags.id'] == 10) {
        $full_sun = 'checked';
      }
      if ($record_tag['tags.id'] == 11) {
        $partial_shade = 'checked';
      }
      if ($record_tag['tags.id'] == 12) {
        $full_shade = 'checked';
      }
    }
    $sticky_colloquial = $colloquial;
    $sticky_genus = $genus;
    $sticky_plant_id = $plant_id;
    $sticky_hardiness = $hardiness;
    $sticky_shrub = ($class == 'Shrub' ? 'checked' : '');
    $sticky_grass = ($class == 'Grass' ? 'checked' : '');
    $sticky_vine = ($class == 'Vine' ? 'checked' : '');
    $sticky_tree = ($class == 'Tree' ? 'checked' : '');
    $sticky_flower = ($class == 'Flower' ? 'checked' : '');
    $sticky_groundcover = ($class == 'Groundcovers' ? 'checked' : '');
    $sticky_other = ($class == 'Other' ? 'checked' : '');
    $sticky_perennial = $perennial;
    $sticky_annual = $annual;
    $sticky_full_sun = $full_sun;
    $sticky_partial_shade = $partial_shade;
    $sticky_full_shade = $full_shade;
    $sticky_explore_constructive_1 = $record['explore_constructive'] == 1 ? 'checked' : '';
    $sticky_explore_sensory_1 = $record['explore_sensory'] == 1 ? 'checked' : '';
    $sticky_physical_1 = $record['physical'] == 1 ? 'checked' : '';
    $sticky_imaginative_1 = $record['imaginative'] == 1 ? 'checked' : '';
    $sticky_restorative_1 = $record['restorative'] == 1 ? 'checked' : '';
    $sticky_expressive_1 = $record['expressive'] == 1 ? 'checked' : '';
    $sticky_play_with_rules_1 = $record['play_with_rules'] == 1 ? 'checked' : '';
    $sticky_bio_play_1 = $record['bio_play'] == 1 ? 'checked' : '';

    $colloquial_feedback_class = 'hidden';
    $genus_feedback_class = 'hidden';
    $plant_id_feedback_class = 'hidden';
    $play_type_feedback_class = 'hidden';
    $class_feedback_class = 'hidden';
    $care_feedback_class = 'hidden';
    $hardiness_feedback_class = 'hidden';

    $plant_id_not_unique = False;
    $colloquial_not_unique = False;
    $genus_not_unique = False;

    if ($update_plant) {
      $colloquial = trim($_POST['colloquial-name']);
      $genus = trim($_POST['scientific-name']);
      $plant_id = trim($_POST['plant-id']);
      $hardiness = trim($_POST['hardiness']);
      $class = trim($_POST['class']);
      $perennial = trim($_POST['perennial']);
      $annual = trim($_POST['annual']);
      $full_sun = trim($_POST['full-sun']);
      $partial_shade = trim($_POST['partial-shade']);
      $full_shade = trim($_POST['full-shade']);

      $explore_constructive_1 = trim($_POST['explore-constructive-1']);
      $explore_sensory_1 = trim($_POST['explore-sensory-1']);
      $physical_1 = trim($_POST['physical-play-1']);
      $imaginative_1 = trim($_POST['imaginative-play-1']);
      $restorative_1 = trim($_POST['restorative-play-1']);
      $expressive_1 = trim($_POST['expressive-play-1']);
      $play_with_rules_1 = trim($_POST['play-with-rules-1']);
      $bio_play_1 = trim($_POST['bio-play-1']);

      $form_valid = true;

      if (empty($colloquial)) {
        $form_valid = False;
        $colloquial_feedback_class = '';
      } else {

        $records = exec_sql_query(
          $db,
          "SELECT * FROM entries WHERE (colloquial = :colloquial) AND (id <> :id);",
          array(
            ':colloquial' => $colloquial,
            ':id' => $id
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
          "SELECT * FROM entries WHERE (genus = :genus) AND (id <> :id);",
          array(
            ':genus' => $genus,
            ':id' => $id
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
          "SELECT * FROM entries WHERE (plant_id = :plant_id) AND (id <> :id);",
          array(
            ':plant_id' => $plant_id,
            ':id' => $id
          )
        )->fetchAll();
        if (count($records) > 0) {
          $form_valid = False;
          $plant_id_not_unique = True;
        }

        if (empty($hardiness)) {
          $form_valid = False;
          $hardiness_feedback_class = '';
        }

        // At least one check box checked:
        if (empty($explore_constructive_1) && empty($explore_sensory_1) && empty($physical_1) && empty($imaginative_1) && empty($restorative_1) && empty($expressive_1) && empty($play_with_rules_1) && empty($bio_play_1)) {
          $form_valid = False;
          $play_type_feedback_class = '';
        }


        if ($form_valid) {
          // update new record into database
          $result = exec_sql_query(
            $db,
            "UPDATE entries SET
            colloquial = :colloquial,
            genus = :genus,
            plant_id = :plant_id,
            hardiness = :hardiness,
            explore_constructive = :explore_constructive,
            explore_sensory = :explore_sensory,
            physical = :physical,
            imaginative = :imaginative,
            restorative = :restorative,
            expressive = :expressive,
            play_with_rules = :play_with_rules,
            bio_play = :bio_play
          WHERE (id = :id);",
            array(
              ':colloquial' => $colloquial,
              ':genus' => $genus,
              ':plant_id' => $plant_id,
              ':hardiness' => $hardiness,
              ':explore_constructive' => (int)((bool)$explore_constructive_1),
              ':explore_sensory' => (int)((bool)$explore_sensory_1),
              ':physical' => (int)((bool)$physical_1),
              ':imaginative' => (int)((bool)$imaginative_1),
              ':restorative' => (int)((bool)$restorative_1),
              ':expressive' => (int)((bool)$expressive_1),
              ':play_with_rules' => (int)((bool)$play_with_rules_1),
              ':bio_play' => (int)((bool)$bio_play_1),
              ':id' => $id
            )
          );

          if (empty($perennial) && empty($annual) && empty($full_sun) && empty($partial_shade) && empty($full_shade)) {
            $form_valid = False;
            $care_feedback_class = '';
          }

          // One radio button checked
          if (empty($class)) {
            $form_valid = False;
            $class_feedback_class = '';
          }

          if (!empty($class)) {
            // query to see the plant's class
            $records_exists_query = "SELECT
          entries.id AS 'entries.id',
          tags.id AS 'tags.id',
          tags.tag_name AS 'tags.tag_name',
          entries_tags.entry_id AS 'entries_tags.entry_id',
          entries_tags.tag_id AS 'entries_tags.tag_id'
          FROM
          tags
          INNER JOIN entries_tags ON
          (entries_tags.tag_id = tags.id)
          INNER JOIN entries ON
          (entries_tags.entry_id = entries.id) WHERE tags.id < 8 AND entries.id = :entries_id;";
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':entries_id' => $id
              )
            )->fetchAll();
            foreach ($records as $record) {
              if ($class == 'Shrub') {
                if (!($record['tags.id'] == 1)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 1
                  ));
                }
              } elseif ($class == 'Grass') {
                if (!($record['tags.id'] == 2)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 2
                  ));
                }
              } elseif ($class == 'Vine') {
                if (!($record['tags.id'] == 3)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 3
                  ));
                }
              } elseif ($class == 'Tree') {
                if (!($record['tags.id'] == 4)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 4
                  ));
                }
              } elseif ($class == 'Flower') {
                if (!($record['tags.id'] == 5)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 5
                  ));
                }
              } elseif ($class == 'Groundcovers') {
                if (!($record['tags.id'] == 6)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 6
                  ));
                }
              } elseif ($class == 'Other') {
                if (!($record['tags.id'] == 7)) {
                  exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id < 8 AND entry_id = :entries_id;", array(
                    ':entries_id' => $id
                  ));
                  exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
                    ':id' => $id,
                    ':tag_id' => 7
                  ));
                }
              }
            }
          }

          $records_exists_query = "SELECT
          entries.id AS 'entries.id',
          tags.id AS 'tags.id',
          tags.tag_name AS 'tags.tag_name',
          entries_tags.entry_id AS 'entries_tags.entry_id',
          entries_tags.tag_id AS 'entries_tags.tag_id'
          FROM
          tags
          INNER JOIN entries_tags ON
          (entries_tags.tag_id = tags.id)
          INNER JOIN entries ON
          (entries_tags.entry_id = entries.id) WHERE tags.id = :tags_id AND entries.id = :entries_id;";


          if (!(empty($perennial))) {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 8,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) == 0) {
              exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);", array(
                ':entry_id' => $id,
                ':tag_id' => 8
              ));
            }
          } else {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 8,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) > 0) {
              exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id = :tag_id AND entry_id = :entries_id;", array(
                ':entries_id' => $id,
                ':tag_id' => 8
              ));
            }
          }


          if (!(empty($annual))) {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 9,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) == 0) {
              exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);", array(
                ':entry_id' => $id,
                ':tag_id' => 9
              ));
            }
          } else {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 9,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) > 0) {
              exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id = :tag_id AND entry_id = :entries_id;", array(
                ':entries_id' => $id,
                ':tag_id' => 9
              ));
            }
          }


          if (!(empty($full_sun))) {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 10,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) == 0) {
              exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);", array(
                ':entry_id' => $id,
                ':tag_id' => 10
              ));
            }
          } else {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 10,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) > 0) {
              exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id = :tag_id AND entry_id = :entries_id;", array(
                ':entries_id' => $id,
                ':tag_id' => 10
              ));
            }
          }

          if (!(empty($partial_shade))) {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 11,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) == 0) {
              exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);", array(
                ':entry_id' => $id,
                ':tag_id' => 11
              ));
            }
          } else {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 11,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) > 0) {
              exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id = :tag_id AND entry_id = :entries_id;", array(
                ':entries_id' => $id,
                ':tag_id' => 11
              ));
            }
          }


          if (!(empty($full_shade))) {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 12,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) == 0) {
              exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:entry_id, :tag_id);", array(
                ':entry_id' => $id,
                ':tags_id' => 12
              ));
            }
          } else {
            $records = exec_sql_query(
              $db,
              $records_exists_query,
              array(
                ':tags_id' => 12,
                ':entries_id' => $id
              )
            )->fetchAll();
            if (count($records) > 0) {
              exec_sql_query($db, "DELETE FROM entries_tags WHERE tag_id = :tag_id AND entry_id = :entries_id;", array(
                ':entries_id' => $id,
                ':tag_id' => 12
              ));
            }
          }


          if ($result) {
            $record_updated = True;
          }
        } else {
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
          $sticky_shrub = ($class == 'shrub' ? 'checked' : '');
          $sticky_grass = ($class == 'grass' ? 'checked' : '');
          $sticky_vine = ($class == 'vine' ? 'checked' : '');
          $sticky_tree = ($class == 'tree' ? 'checked' : '');
          $sticky_flower = ($class == 'flower' ? 'checked' : '');
          $sticky_groundcover = ($class == 'groundcover' ? 'checked' : '');
          $sticky_other = ($class == 'other' ? 'checked' : '');
          $sticky_perennial = (empty($perennial) ? '' : 'checked');
          $sticky_annual = (empty($annual) ? '' : 'checked');
          $sticky_full_sun = (empty($full_sun) ? '' : 'checked');
          $sticky_partial_shade = (empty($partial_shade) ? '' : 'checked');
          $sticky_full_shade = (empty($full_shade) ? '' : 'checked');
          $sticky_hardiness = $hardiness;
        }
      }
    }
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
  <?php ?>
  <h1>Edit Plant</h1>
  <?php if ($record == NULL) { ?>

    <p>Unknown plant, &quot;<?php echo htmlspecialchars($plant_record_colloquial); ?>&quot;.</p>

    <p>Please contact the site adminstrator for assistance, or <a href="/admin-catalog">go back to the catalog</a>.</p>

  <?php } elseif ($record_updated) { ?>

    <p>The plant, <?php echo htmlspecialchars(strtolower($colloquial)); ?>, was successfully updated in the catalog.</p>

    <p><a href="/admin-catalog">Return to catalog; view all plant records.</a></p>

  <?php } else { ?>
    <div id="edit-plant">
      <form class="edit" action="/edit-plants?<?php echo http_build_query(array('plant' => $plant_record_colloquial)); ?>" method="post" novalidate>
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

        <div id="feedback-hardiness" class="feedback <?php echo $hardiness_feedback_class; ?>">Please enter the plant's hardiness zone.</div>
        <div class="form-label">
          <label for="hardiness">Hardiness Zone:</label>
          <input type="text" name="hardiness" id="hardiness" value="<?php echo htmlspecialchars($sticky_hardiness); ?>" />
        </div>

        <!-- Upload Images -->
        <!-- TODO -->

        <div>
          <p>What is the classification of the plant?</p>
        </div>
        <div id="feedback-class" class="feedback <?php echo $class_feedback_class; ?>">Please select a plant classification.</div>

        <div class="form-label">
          <input id="shrub" type="radio" name="class" value="Shrub" <?php echo htmlspecialchars($sticky_shrub); ?> /><label for="shrub">Shrub</label>
        </div>
        <div class="form-label">
          <input id="grass" type="radio" name="class" value="Grass" <?php echo htmlspecialchars($sticky_grass); ?> /><label for="grass">Grass</label>
        </div>
        <div class="form-label">
          <input id="vine" type="radio" name="class" value="Vine" <?php echo htmlspecialchars($sticky_vine); ?> /><label for="vine">Vine</label>
        </div>
        <div class="form-label">
          <input id="tree" type="radio" name="class" value="Tree" <?php echo htmlspecialchars($sticky_tree); ?> /><label for="tree">Tree</label>
        </div>
        <div class="form-label">
          <input id="flower" type="radio" name="class" value="Flower" <?php echo htmlspecialchars($sticky_flower); ?> /><label for="flower">Flower</label>
        </div>
        <div class="form-label">
          <input id="groundcover" type="radio" name="class" value="Groundcovers" <?php echo htmlspecialchars($sticky_groundcover); ?> />
          <label for="groundcover">Groundcover</label>
        </div>
        <div class="form-label">
          <input id="other" type="radio" name="class" value="Other" <?php echo htmlspecialchars($sticky_other); ?> />
          <label for="other">Other</label>
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
          <p>What care does the plant need? Check the boxes below:</p>
        </div>

        <div id="feedback-care" class="feedback <?php echo $care_feedback_class; ?>">Please select at least one form of care.</div>
        <div class="form-label">
          <input type="checkbox" name="perennial" id="perennial" <?php echo htmlspecialchars($sticky_perennial); ?> />
          <label for="perennial">Perennial</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="annual" id="annual" <?php echo htmlspecialchars($sticky_annual); ?> />
          <label for="annual">Annual</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="full-sun" id="full-sun" <?php echo htmlspecialchars($sticky_full_sun); ?> />
          <label for="full-sun">Needs full sun</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="partial-shade" id="partial-shade" <?php echo htmlspecialchars($sticky_partial_shade); ?> />
          <label for="partial-shade">Needs partial shade</label>
        </div>
        <div class="form-label">
          <input type="checkbox" name="full-shade" id="full-shade" <?php echo htmlspecialchars($sticky_full_shade); ?> />
          <label for="full-shade">Needs full shade</label>
        </div>

        <input type="hidden" name="update-id" value="<?php echo htmlspecialchars($id); ?>" />
        <div class="align-right">
          <button type="submit">Edit Plant in Catalog</button>
        </div>
      </form>
    </div>



  <?php } ?>



</body>
