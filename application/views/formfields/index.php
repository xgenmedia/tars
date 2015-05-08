<style type="text/css">
    #formfieldWraper{
        margin-top: 70px;
    }
    div#formfieldWraper section#mainContent{
        margin-left: 150px;    
    } 
</style>
<div id="formfieldWraper">
    <a href="<?php echo base_url('/formfields/createfield'); ?>">Create Field</a>
    <?php ?>
    <section id="mainContent">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Required</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($fields)) {
                    $i = 1;
                    foreach ($fields as $key => $value) : ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value->name; ?></td>
                            <td><?php echo $value->type; ?></td>
                            <td><?php echo $value->required; ?></td>
                        </tr>
                        <?php
                    endforeach;
                } else {
                    ?>	
                    <tr>
                        <td colspan="6">No record found</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </section>
</div>

