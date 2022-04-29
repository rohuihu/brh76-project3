<?php $title = 'Catalog - Playful Plants Project';
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
$result_entries = exec_sql_query($db, 'SELECT * FROM entries;');
$records_entries = $result_entries->fetchAll();

define("MAX_FILE_SIZE", 1000000);

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
$explore_constructive_1 = '';
$explore_sensory_1 = '';
$physical_1 = '';
$imaginative_1 = '';
$restorative_1 = '';
$expressive_1 = '';
$play_with_rules_1 = '';
$bio_play_1 = '';
$class = '';
$class_id = 6;
$upload_filename = "0";
$upload_ext = "jpg";
$hardiness = "";

// feedback classes
$colloquial_feedback_class = 'hidden';
$genus_feedback_class = 'hidden';
$plant_id_feedback_class = 'hidden';
$play_type_feedback_class = 'hidden';
$class_feedback_class = 'hidden';
$care_feedback_class = 'hidden';
$hardiness_feedback_class = 'hidden';

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
  $class = trim($_POST['class']);
  $perennial = trim($_POST['perennial']);
  $annual = trim($_POST['annual']);
  $full_sun = trim($_POST['full-sun']);
  $partial_shade = trim($_POST['partial-shade']);
  $full_shade = trim($_POST['full-shade']);
  $hardiness = trim($_POST['hardiness']);


  $form_valid = True;

  if (empty($colloquial)) {
    $form_valid = False;
    $colloquial_feedback_class = '';
  } else {
    $records = exec_sql_query(
      $db,
      "SELECT * FROM entries WHERE (colloquial = :colloquial);",
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
      "SELECT * FROM entries WHERE (genus = :genus);",
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
      "SELECT * FROM entries WHERE (plant_id = :plant_id);",
      array(
        ':plant_id' => $plant_id
      )
    )->fetchAll();
    if (count($records) > 0) {
      $form_valid = False;
      $plant_id_not_unique = True;
    }
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
  if (empty($perennial) && empty($annual) && empty($full_sun) && empty($partial_shade) && empty($full_shade)) {
    $form_valid = False;
    $care_feedback_class = '';
  }

  // One radio button checked
  if (empty($class)) {
    $form_valid = False;
    $class_feedback_class = '';
  }
  // else {
  //   if ($class == 'shrub') {
  //     $class_id = 0;
  //   } elseif ($class == 'grass') {
  //     $class_id = 1;
  //   } elseif ($class == 'vine') {
  //     $class_id = 2;
  //   } elseif ($class == 'tree') {
  //     $class_id = 3;
  //   } elseif ($class == 'flower') {
  //     $class_id = 4;
  //   } elseif ($class == 'groundcover') {
  //     $class_id = 5;
  //   } elseif ($class == 'other') {
  //     $class_id = 6;
  //   }
  // }


  if ($form_valid) {
    $show_confirmation = True;
    $show_form = False;
    $result_entries = exec_sql_query(
      $db,
      "INSERT INTO entries (colloquial, genus, plant_id, image_id, file_ext, explore_constructive, explore_sensory, physical, imaginative, restorative, expressive, play_with_rules, bio_play, hardiness) VALUES (:colloquial, :genus, :plant_id, :image_id, :file_ext, :explore_constructive, :explore_sensory, :physical, :imaginative, :restorative, :expressive, :play_with_rules, :bio_play, :hardiness);",
      array(
        ':colloquial' => $colloquial,
        ':genus' => $genus,
        ':plant_id' => $plant_id,
        ':image_id' => "0",
        ':file_ext' => $upload_ext,
        ':explore_constructive' => (int)((bool)$explore_constructive_1),
        ':explore_sensory' => (int)((bool)$explore_sensory_1),
        ':physical' => (int)((bool)$physical_1),
        ':imaginative' => (int)((bool)$imaginative_1),
        ':restorative' => (int)((bool)$restorative_1),
        ':expressive' => (int)((bool)$experessive_1),
        ':play_with_rules' => (int)((bool)$play_with_rules_1),
        ':bio_play' => (int)((bool)$bio_play_1),
        ':hardiness' => $hardiness
      )
    );
    $record_id = $db->lastInsertId('id');

    $upload = $_FILES['upload-img'];

    // insert image if no problem with uploading code
    // if user didn't upload img, insert 0.jpg to database
    if ($upload['error'] == UPLOAD_ERR_OK) {

      $upload_filename = basename($upload['name']);
      $record_img_name = $record_id;

      $upload_ext = strtolower(pathinfo($upload_filename, PATHINFO_EXTENSION));

      // invalid form if file ext isn't reflective of what's allowed
      if (!in_array($upload_ext, array('jpg'))) {
        $form_valid = false;
      }
    } else {
      $upload_filename = "0";
      $record_img_name = "0";
      $upload_ext = "jpg";
    }

    // new record is updated with image_id
    exec_sql_query($db, "UPDATE entries SET
      image_id = :image_id,
      file_ext = :file_ext
       WHERE id = :id;", array(
      ':image_id' => $record_img_name,
      ':file_ext' => $upload_ext,
      ':id' => $record_id
    ));

    $img_records = exec_sql_query(
      $db,
      "SELECT * FROM entries WHERE (image_id = :image_id);",
      array(
        ':image_id' => $image_id
      )
    )->fetchAll();
    if (count($img_records) == 0) {
      $id_filename = 'public/uploads/entries/' . $record_id . '.' . $upload_ext;
      move_uploaded_file($upload["tmp_name"], $id_filename);
    }

    if (!empty($class)) {
      if ($class == 'shrub') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 1
        ));
      } elseif ($class == 'grass') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 2
        ));
      } elseif ($class == 'vine') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 3
        ));
      } elseif ($class == 'tree') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 4
        ));
      } elseif ($class == 'flower') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 5
        ));
      } elseif ($class == 'groundcover') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 6
        ));
      } elseif ($class == 'other') {
        exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
          ':id' => $record_id,
          ':tag_id' => 7
        ));
      }
    }
    if (!empty($perennial)) {
      exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
        ':id' => $record_id,
        ':tag_id' => 8
      ));
    }
    if (!empty($annual)) {
      exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
        ':id' => $record_id,
        ':tag_id' => 9
      ));
    }
    if (!empty($full_sun)) {
      exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
        ':id' => $record_id,
        ':tag_id' => 10
      ));
    }
    if (!empty($partial_shade)) {
      exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
        ':id' => $record_id,
        ':tag_id' => 11
      ));
    }
    if (!empty($full_shade)) {
      exec_sql_query($db, "INSERT INTO entries_tags (entry_id, tag_id) VALUES (:id, :tag_id);", array(
        ':id' => $record_id,
        ':tag_id' => 12
      ));
    }


    if ($result_entries) {
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

// // Delete plant from DB
$record_plant_id = trim($_GET['delete']);
exec_sql_query($db, "DELETE FROM entries WHERE (id = :id);", array(
  ':id' => $record_plant_id
));
exec_sql_query($db, "DELETE FROM entries_tags WHERE (entry_id = :id);", array(
  ':id' => $record_plant_id
));
$result_entries = exec_sql_query($db, 'SELECT * FROM entries;');
$records_entries = $result_entries->fetchAll();
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
  <section class="login">
    <?php if (is_user_logged_in()) { ?>
      <h1 id="catalog-intro">Catalog</h1>
      <div class="nav">
        <nav>
          <ul>
            <li><a href="/">Consumer View</a></li>
            <li id="nav-logout"><a href="<?php echo logout_url(); ?>">Logout Administrator View</a></li>
          </ul>
        </nav>
      </div>
      <div class="catalog-intro">
        <p>Below is a table of all the plant records, along with their growth needs and an image.</p>
        <p><a href="#add-plant">Add a plant to the database.</a></p>
      </div>
      <section class="catalog">
        <div class="align-block">
          <table>
            <tr>
              <th>Action</th>
              <th>Name</th>
              <th>Plant ID</th>
              <th>Image</th>
              <!-- <th>Growth Needs</th> -->
              <th>Play Type Categorization</th>
            </tr>

            <?php foreach ($records_entries as $record_entry) { ?>
              <tr>
                <!-- add plant names -->
                <td>
                  <ul>
                    <li>
                      <div>
                        <form class="edit" method="get" action="/edit-plants" novalidate>

                          <input type="hidden" name="edit" value="<?php echo htmlspecialchars($record_entry['colloquial']); ?>" />

                          <button class="edit-submit" type="submit">
                            Edit Plant
                          </button>
                        </form>

                      </div>
                    </li>
                    <li>
                      <form class="delete" method="get" action="/admin-catalog" novalidate>

                        <input type="hidden" name="delete" value="<?php echo htmlspecialchars($record_entry['id']); ?>" />

                        <button class="delete-submit" type="submit">
                          Delete Plant
                        </button>
                      </form>
                    </li>
                  </ul>
                </td>


                <td>
                  <ul>
                    <li>
                      <?php echo htmlspecialchars($record_entry["colloquial"]) ?>
                    </li>
                    <li class="scientific">
                      <?php echo htmlspecialchars($record_entry["genus"]) ?>
                    </li>

                    <li>
                      General classification:
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
                        ':entries_id' => $record_entry['id']
                      ));
                      foreach ($classes as $class) {
                        echo htmlspecialchars($class['tags.tag_name']);
                      } ?>
                    </li>
                  </ul>
                </td>

                <!-- add plant id -->
                <td>
                  <?php echo htmlspecialchars($record_entry["plant_id"]) ?>
                </td>


                <!-- Add plant image -->
                <td class="catalog-img">
                  <img src="/public/uploads/entries/<?php echo htmlspecialchars($record_entry['image_id']) . "." .  htmlspecialchars($record_entry['file_ext']); ?>" alt="<?php echo htmlspecialchars($record_entry['colloquial']) ?> picture">
                </td>

                <!-- add growth needs -->

                <!-- add play type categorization -->
                <td>
                  <ul>
                    <?php
                    if ($record_entry['explore_constructive'] == 1) { ?>
                      <li>
                        Exploratory Constructive Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['explore_sensory'] == 1) { ?>
                      <li>
                        Exploratory Sensory Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['physical'] == 1) { ?>
                      <li>
                        Physical Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['imaginative'] == 1) { ?>
                      <li>
                        Imaginative Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['restorative'] == 1) { ?>
                      <li>
                        Restorative Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['expressive'] == 1) { ?>
                      <li>
                        Expressive Play
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['play_with_rules'] == 1) { ?>
                      <li>
                        Play With Rules
                      </li>
                    <?php } ?>
                    <?php
                    if ($record_entry['bio_play'] == 1) { ?>
                      <li>
                        Bio Play
                      </li>
                    <?php } ?>
                  </ul>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </section>




      <div id="add-plant">
        <h3>Add a Plant!</h3>
        <p id="directions">Fill out the form below to add a plant to the database.</p>

        <form id="add-form" method="post" action="/admin-catalog" enctype="multipart/form-data" novalidate>

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
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

          <div class="form-label">
            <label for="upload-img">Upload Image: </label>
            <input type="file" name="upload-img" id="upload-img" accept="image/png, image/jpg, image/svg" />
          </div>

          <div>
            <p>What is the classification of the plant?</p>
          </div>
          <div id="feedback-class" class="feedback <?php echo $class_feedback_class; ?>">Please select a plant classification.</div>

          <div class="form-label">
            <input id="shrub" type="radio" name="class" value="shrub" <?php echo htmlspecialchars($sticky_shrub); ?> /><label for="shrub">Shrub</label>
          </div>
          <div class="form-label">
            <input id="grass" type="radio" name="class" value="grass" <?php echo htmlspecialchars($sticky_grass); ?> /><label for="grass">Grass</label>
          </div>
          <div class="form-label">
            <input id="vine" type="radio" name="class" value="vine" <?php echo htmlspecialchars($sticky_vine); ?> /><label for="vine">Vine</label>
          </div>
          <div class="form-label">
            <input id="tree" type="radio" name="class" value="tree" <?php echo htmlspecialchars($sticky_tree); ?> /><label for="tree">Tree</label>
          </div>
          <div class="form-label">
            <input id="flower" type="radio" name="class" value="flower" <?php echo htmlspecialchars($sticky_flower); ?> /><label for="flower">Flower</label>
          </div>
          <div class="form-label">
            <input id="groundcover" type="radio" name="class" value="groundcover" <?php echo htmlspecialchars($sticky_groundcover); ?> />
            <label for="groundcover">Groundcover</label>
          </div>
          <div class="form-label">
            <input id="other" type="radio" name="class" value="other" <?php echo htmlspecialchars($sticky_other); ?> />
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
          <div class="align-right">
            <input id="add-submit" type="submit" name="add-plant" value="Add Plant to Catalog" />
          </div>
        </form>
        <p id="#to-top"><a href="#catalog-intro">Back to top</a></p>
      </div>
      <?php if ($show_confirmation) { ?>
        <div class="add-confirmation">
          <p>The plant, <?php echo htmlspecialchars($colloquial); ?>, has been added to the catalog. <a href="/admin-catalog">Add another plant</a>!</p>
        </div>
      <?php } ?>

    <?php } else { ?>
      <div class="nav">
        <a href="/">
          <nav>
            <ul>
              <li>Back to Homepage</li>
            </ul>
          </nav>
        </a>
      </div>
      <div class="login">
        <div>
          <div>
            <h2 id="login-header">Administrator Login</h2>
          </div>

          <section>
            <?php
            echo_login_form('/admin-catalog', $session_messages);
            ?>
          </section>
        </div>
      </div>
    <?php } ?>
  </section>


</body>

</html>
