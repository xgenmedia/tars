<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li><a href="<?php echo base_url("dashboard");?>">Dashboard</a></li>
  		<li class="active">Group</li>
  		<li class="pull-right">
  			<a href="<?php echo base_url("group/edit");?>"><i class="glyphicon glyphicon-plus"></i> Add Group</a>
  		</li>
	</ol>
	<div class="row-fluid">
		 <div class="col-sm-3">
		 		<?php $this->load->view("components/left_side_bar");?>
		 </div>
		 <div class="col-sm-9">
		 		<!--   Success and Error Message --> 
				<?php if($this->session->flashdata('success_message')) {?>
					<p class="bg-primary"> <?php echo $this->session->flashdata('success_message');?> </p>
				<?php } ?>
				<?php if($this->session->flashdata('error_message')) {?>
					<p class="bg-danger"> <?php echo $this->session->flashdata('error_message');?> </p>
				<?php } ?>
				<!--                             -->
		 		<table class="table table-hover">
		 			<thead>
		 				<tr>
		 					<th>Sl. No.</th>
		 					<th>Name</th>
		 					<th>Active</th>
		 					<th>Actions</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php 
		 					$i = 1;
		 					foreach ($groups as $key => $group) :?>
			 				<tr>
			 					<td> <?php echo $i++; ?></td>
			 					<td><?php echo e($group->title);?></td>
			 					<td>
			 						<?php echo $group->is_active; ?>  	
			 					</td>
			 					<td>
			 						<a title="Group Rights" href="<?php echo site_url("group/rights/".$group->id);?>" > <i class="glyphicon glyphicon-new-window"></i></a>
			 						 <?php echo btn_edit("group/edit/".$group->id);?>
			 						 <?php echo btn_delete("group/delete/".$group->id);?>
			 					</td>
			 				</tr>
		 				<?php endforeach;?>
		 			</tbody>
		 		</table>
		 </div>
	</div>
</div>