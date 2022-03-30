<?php $title = 'Not Found'; ?>
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
  <p id="not-found-notice">We're sorry. The page you were looking for, <em>&quot;<?php echo htmlspecialchars($request_uri); ?>&quot;</em>, does not exist. Please go back to the <a href="/">original page</a>.</p>

</body>

</html>
