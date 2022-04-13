<?php $title = 'Playful Plants Project';

$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

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
      <div class="card">
        <a href="/plant-details">
          <div>
            <h1>Cutleaf Weeping BirchÂ</h1>
            <h2>Betula pendula 'Dalecarlica'Â</h2>
            <h3>General Classification: Tree</h3>
            <!-- Image source: Personal artwork by Bella Hu -->
            <img src="/public/uploads/entries/generic-plant-scaled.jpg" alt="No picture provided">
          </div>
        </a>
      </div>
      <div class="card">
        <h1>High Mallow</h1>
        <h2>Malva sylvestris</h2>
        <h3>General Classification: Flower</h3>
        <img src="/public/uploads/entries/FL_27.jpg" alt="High Mallow">
      </div>
      <div class="card">
        <h1>Zebra Grass</h1>
        <h2>Miscanthus sinensis 'Zebrinus'</h2>
        <h3>General Classification: Grass</h3>
        <img src="/public/uploads/entries/generic-plant-scaled.jpg" alt="No picture provided">
      </div>
      <div class="card">
        <h1>Pincushion Moss</h1>
        <h2>Leucobryum glaucum</h2>
        <h3>General Classification: Other</h3>
        <img src="/public/uploads/entries/generic-plant-scaled.jpg" alt="No picture provided">
      </div>
      <div class="card">
        <h1>Blue Violet</h1>
        <h2>Viola sororia</h2>
        <h3>General Classification: Groundcover</h3>
        <img src="/public/uploads/entries/GR_15.jpg" alt="Blue Violet">
      </div>
    </section>
  </section>


</body>

</html>
