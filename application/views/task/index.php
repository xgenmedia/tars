<div class="container-fluid">
	<ol class="breadcrumb" style="margin-top:80px;">
		<li><a href="<?php echo base_url("dashboard");?>">Dashboard</a></li>
  		<li class="active">Resource</li>
  		<li class="pull-right">
  			<a href="<?php echo base_url("task/edit");?>"><i class="glyphicon glyphicon-plus"></i> Add Task</a>
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
		 					<th>Title</th>
		 					<th>Code</th>
		 					<th>Active</th>
		 					<th>Actions</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php 
		 					$i = 1;
		 					foreach ($tasks as $key => $task) :?>
			 				<tr>
			 					<td> <?php echo $i++; ?></td>
			 					<td><?php echo e($task->title);?></td>
			 					<td><?php echo e($task->code);?></td>
			 					<td>
			 						<?php echo $task->is_active; ?>  	
			 					</td>
			 					<td>
			 						 <?php echo btn_edit("task/edit/".$task->id);?>
			 						 <?php echo btn_delete("task/delete/".$task->id);?>
			 					</td>
			 				</tr>
		 				<?php endforeach;?>
		 			</tbody>
		 		</table>
		 </div>
	</div>
</div>