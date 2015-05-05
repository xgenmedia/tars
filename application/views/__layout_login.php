<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: Login ::</title>
    <!-- CSS -->
        <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
      
    <!-- JS -->
        <!-- jQuery -->
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Bootstrap JS -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div style="padding:50px 0px 20px 0px;"></div>
    <div class="container-fluid">
      <div class="row"> 
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Login</h4>
                Please login with your credentials
              </div>
              <div class="modal-body">
                  <?php $this->load->view($subview);?>
              </div>
              <div class="modal-footer">
                  &copy; <?php echo $site_name;?>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>
    </div>
  

		
  </body>
  </html>