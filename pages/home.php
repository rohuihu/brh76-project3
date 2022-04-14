<?php $title = 'Playful Plants Project';

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');
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
                                    'colloquial' => $record_entries['colloquial'],
                                    'genus' => $record_entries['genus'],
                                    'plant_id' => $record_entries['plant_id'],
                                    'file_ext' => $record_entries['file_ext'],
                                    'class' => $record_entries['class']
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
              <img src="/public/uploads/entries/<?php echo htmlspecialchars($record_entries["plant_id"] . "." . $record_entries["file_ext"]) ?>" alt="No picture provided">
            </div>
          </a>
        </div>
      <?php } ?>
    </section>
  </section>


</body>

</html>
