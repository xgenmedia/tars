<?php echo '<pre>';
print_r($result);
?>
<div id="formTestWrapper">
    <?php
    echo form_open("", array('class' => 'form-horizontal'));
    foreach ($result as $key => $value):
        switch ($value->type):
            case 'text':
                echo 'type is text';
            break;
            case 'password':
                echo 'type is password';
            break;
            case 'select':
                echo 'type is select';
            break;
        endswitch;
        echo '<pre>';
        
    endforeach;
    ?>

    <?php echo form_close(); ?>

<?php die(__FILE__ . ' ' . __LINE__); ?>
</div>
