    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	

	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li>Rarebook Page</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	
	<!-- ======= Rarebook Details Section ======= -->
	<div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard">
			<h2 class="">Rarebook</h2>
			
			<!--Page Content-->
				<div class="mb-5">
				<div class="container">

				<div class="mt-3">
				<div class="titbg"><img style="width:100%;height:120pt" src="<?=base_url(); ?>public/assets/images/rarebooks_sml.png"></img></div>
				<h3 class="text-center">Rarebook</h3>
        		<div class="table-responsive">
			<?php //print_r($rarebook_data); ?>
											
				<?php
				if (!empty($rarebook_data)) {
						  echo "<table id = 'myTable' class = 'table table-bordered table-striped' style = 'width:100%'>
									<thead class='table-thead'>
									<tr>
										<th>Book Id</th>
										<th>AMAR Id</th>
										<th>Title</th>
										<th>Author</th>
										<th>Physical Location</th>
										<th>Subject</th>
									</tr></thead>";
						  // output data of each row
						  foreach($rarebook_data as $rbk) {
								   echo "<tr><td>".$rbk->rb_id."</td>".
											"<td>".$rbk->amar_id."</td>".
											"<td><a href='./rarebook_details/".$rbk->rb_id."' target='_blank'>".$rbk->title_phonetic."</a></td>".
											"<td>".$rbk->author_phonetic."</td>".
											"<td>".$rbk->physical_location."</td>".
											"<td>".$rbk->subject."</td>
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
		
		



	

	