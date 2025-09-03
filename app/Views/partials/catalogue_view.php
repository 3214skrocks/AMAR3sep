    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	

	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li>Catalogue Page</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	
	<!-- ======= Catalogue Details Section ======= -->
	<div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard">
			<h2 class="">Catalogue</h2>
			
			<!--Page Content-->
				<div class="mb-5">
				<div class="container">

				<div class="mt-3">
				<div class="titbg"><img style="width:100%;height:120pt" src="<?=base_url(); ?>public/assets/images/cat_sml.png"></img></div>
				<h3 class="text-center">Catalogue</h3>
        		<div class="table-responsive">
			<?php //print_r($catalogue_data); ?>
											
				<?php
				if (!empty($catalogue_data)) {
						  echo "<table id = 'myTable' class = 'table table-bordered table-striped' style = 'width:100%'>
									<thead class='table-thead'>
									<tr>
										<th>CAT.Id</th>
										<th>AMAR Id</th>
										<th>Title</th>
										<th>Author</th>
										<th>Sysytem</th>
										<th>Location</th>
									</tr></thead>";
						  // output data of each row
						  foreach($catalogue_data as $cat) {
								   echo "<tr><td>".$cat->cat_id."</td>".
											"<td>".$cat->amar_id."</td>".
											"<td><a href='./catalogue_details/".$cat->cat_id."' target='_blank'>".$cat->title_phonetic."</a></td>".
											"<td>".$cat->author_phonetic."</td>".
											"<td>".$cat->ayush_system."</td>".
											"<td>".$cat->physical_location."</td>
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
		
		



	

	