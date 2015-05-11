<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <!-- CSS -->
           <!-- Bootstrap CSS -->
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
           <!-- Dynamic CSS -->  
           <?php foreach ($css as $key => $CssPaths) {?>
              <link rel="stylesheet" href="<?php echo $CssPaths;?>">
           <?php } ?>
    <!-- JS -->
           <!-- jQuery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
           <!-- Bootstrap JS -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
           <!-- Dynamic JS -->
             <?php foreach ($js as $key => $jsPaths) { ?>
                <script src="<?php echo $jsPaths; ?>"></script>
             <?php } ?>
  </head>
  <body>