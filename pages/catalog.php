<?php $title = 'Catalog - Playful Plants Project';
$db = open_sqlite_db('tmp/site.sqlite');
$result = exec_sql_query($db, 'SELECT * FROM plants;');
$records = $result->fetchAll();
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
  <div class="add-confirmation">
    <p>The plant, <?php echo htmlspecialchars($colloquial); ?>, has been added to the catalog. <a href="/">Add another plant</a>!</p>
  </div>
</body>
