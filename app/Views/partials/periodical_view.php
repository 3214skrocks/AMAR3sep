    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	

	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li>Periodicals Page</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	
	<!-- ======= Periodicals Details Section ======= -->
	<div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard">
			<h2 class="">Periodicals</h2>
			
			<!--Page Content-->
				<div class="mb-5">
				<div class="container">

				<div class="mt-3">
				<div class="titbg"><img style="width:100%;height:120pt" src="<?=base_url(); ?>public/assets/images/periodicals_sml.png"></img></div>
				<h3 class="text-center">Periodicals</h3>
        		<div class="table-responsive">
			<?php //print_r($periodicals_data); ?>
											
				<?php
				if (!empty($periodicals_data)) {
						  echo "<table id = 'myTable' class = 'table table-bordered table-striped' style = 'width:100%'>
									<thead class='table-thead'>
									<tr>
										<th>Per Id</th>
										<th>AMAR Id</th>
										<th>Title</th>
										<th>Publisher</th>
										<th>Editor</th>
										<th>Place of Publishers</th>
									</tr></thead>";
						  // output data of each row
						  foreach($periodicals_data as $per) {
								   echo "<tr><td>".$per->per_id."</td>".
											"<td>".$per->amar_id."</td>".
											"<td><a href='./periodical_details/".$per->per_id."' target='_blank'>".$per->per_title."</a></td>".
											"<td>".$per->publisher."</td>".
											"<td>".$per->editor."</td>".
											"<td>".$per->place_of_publishers."</td>
								 </tr>";
						  }
						  echo "</table>";
						} else {
						  echo "0 results";
						}
						?>
			</div>
			</div>
				</div>
			</div>
			<!--Page Content End-->
                                           
										
		</div>
	</div>
		
	
	<?= $this->endSection(); ?>
		
		



	

	