<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <?php echo $_styles; ?>

</head>
<body <?php echo $body_class; ?>>

  <?php echo $content; ?>
  <?php echo $_scripts; ?>

</body>
</html>