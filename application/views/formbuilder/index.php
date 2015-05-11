<style type="text/css">
	#manageWrapper{
		margin-top:70px;
	}
	#formNavigation{
		margin-left: 100px;
	}
	#mainContent{
		margin-left: 100px;
	}
</style>
<div id="manageWrapper">
    <div id="formNavigation">
    	<a href="<?php echo base_url('formbuilder/createform') ?>">Create Form</a>
    </div>
    <?php ?>
    
    <section id="mainContent">
        <table class="table" id="formLists">
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($forms)) {
                    $i = 1;
                    foreach ($forms as $key => $value) : ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><a href="<?php echo base_url('formbuilder/testform/'.$value->id) ?>"><?php echo $value->name; ?></a></td>
                            <td><?php echo $value->is_active; ?></td>
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