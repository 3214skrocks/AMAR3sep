    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	
				
	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li><a href="<?=base_url(); ?>rarebook">Rarebooks</a></li>
					<li>Rarebook Details</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	<?php //print_r($rb_data); ?>
		<?php						
						if (!empty($rb_data)) {
								foreach($rb_data as $rbd) {
								
									//Introductory
									$rb_id=$rbd->rb_id;
									$amar_id=$rbd->amar_id;
									//Technical
									$title_phonetic=$rbd->title_phonetic;
									$physical_location=$rbd->physical_location;
									$accession_no_at_source=$rbd->accession_no_at_source;
									$author_phonetic=$rbd->author_phonetic;
									$time_of_author=$rbd->time_of_author;
									$edited_by=$rbd->edited_by;
									$translated_by=$rbd->translated_by;
									$commentary_by=$rbd->commentary_by;
									$commentary=$rbd->commentary;
									$foreword_by=$rbd->foreword_by;
									$ayush_system=$rbd->ayush_system;
									$subject=$rbd->subject;
									$language=$rbd->language;
									$script=$rbd->script;
									$place_and_state=$rbd->place_and_state;
									// $state=$rbd->state;
									//Publication Details
									$publisher_details=$rbd->publisher_details;
									$year_of_pub=$rbd->year_of_publication;
									$no_of_pages=$rbd->no_of_pages;
									$about_the_book=$rbd->about_the_book;
									$other_info=$rbd->other_info;
									//Digitization Status
									$digi_by=$rbd->digitized_by;
									$date_of_digi=$rbd->date_of_digitization;
									$front_image=$rbd->front_image;
									$back_image=$rbd->back_image;
							  }
						} else {
							echo "0 results";
						}
						
			?>
	
	<!-- ======= Manuscript Details Section start ======= -->
	<div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard manbg1" style="">
			<h2 class="">Rarebook</h2>
			
			<!--Page Content-->
				<!--<div class="mb-5">
				<div class="container">-->
					<div class="mt-2">
				
				<div class="titbg"><img style="width:100%;height:100pt" src="<?=base_url(); ?>public/assets/images/periodicals_sml.png"></img></div>
				
				<h3 class="text-center mt-2 h3title"><?php echo $title_phonetic; ?></h3>
				<div class="row">
				<!--Introductory-->
				  <div class="col-md-12">
				  	<h4 class="text-left h4title table-thead">&nbsp;Introductory</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">S.NO :</th><td class="col-md-3"><?php echo $rb_id; ?></td>
									<th class="col-md-3">AMAR ID :</th><td class="col-md-3"><?php echo $amar_id; ?></td></tr>
								<tr><th class="col-md-3">ACCESSION NO. AT SOURCE :</th><td class="col-md-3"><?php echo $accession_no_at_source; ?></td>
									<th class="col-md-3">PHYSICAL LOCATION :</th><td class="col-md-3"><?php echo $physical_location; ?></td></tr>
								<!--<tr><th class="col-md-3">ACCESSION NO. AT SOURCE :</th><td class="col-md-3"><?php //echo $accession_no_source; ?></td>
									<th class="col-md-3">AUTHOR OF THE BOOK :</th><td class="col-md-3"><?php //echo $author_of_book; ?></td></tr>
								<tr><th class="col-md-3">TIME OF AUTHOR :</th><td class="col-md-3"><?php //$time_of_author ?></td></tr>-->
							</table>
					</div>
				  </div>
				  <!--Technical-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Technical</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th colspan="1" class="col-md-2">TITLE OF THE RARE BOOK :</th><td colspan="3" class="col-md-10"><?php echo $title_phonetic; ?></td></tr>
								<tr><th class="col-md-3">AUTHOR OF THE BOOK :</th><td class="col-md-3"><?php echo $author_phonetic; ?></td>
									<th class="col-md-3">TIME OF AUTHOR:</th><td class="col-md-3"><?php echo $time_of_author; ?></td></tr>
								<tr><th class="col-md-3">EDITED BY :</th><td class="col-md-3"><?php echo $edited_by; ?></td>
									<th class="col-md-3">TRANSLATED BY :</th><td class="col-md-3"><?php echo $translated_by; ?></td></tr>
								<tr><th class="col-md-3">COMMENTARY BY:</th><td class="col-md-3"><?php echo $commentary_by; ?></td>
									<th class="col-md-3">NAME OF COMMENTARY :</th><td class="col-md-3"><?php echo $commentary; ?></td></tr>
								<tr><th class="col-md-3">FOREWORD BY :</th><td class="col-md-3"><?php echo $foreword_by; ?></td>
									<th class="col-md-3">AYUSH SYSTEM :</th><td class="col-md-3"><?php echo $ayush_system; ?></td></tr>
								<tr><th class="col-md-3">SUBJECT :</th><td class="col-md-3"><?php echo $subject; ?></td>
									<th class="col-md-3">LANGUAGE :</th><td class="col-md-3"><?php echo $language; ?></td></tr>
								<tr><th class="col-md-3">SCRIPT:</th><td class="col-md-3"><?php echo $script; ?></td>
									<th class="col-md-3">PLACE & STATE :</th><td class="col-md-3"><?php echo $place_and_state; ?></td></tr>
								</table>
					</div>
				  </div>
				  <!--PUBLISHER-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;PUBLISHER</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">PUBLISHER DETAILS :</th><td class="col-md-3"><?php echo $publisher_details; ?></td>
									<th class="col-md-3">YEAR OF PUBLICATION :</th><td class="col-md-3"><?php echo $year_of_pub; ?></td></tr>
								<tr><th class="col-md-3">NO OF PAGES :</th><td class="col-md-3"><?php echo $no_of_pages; ?></td></tr>
								<tr><th colspan="1" class="col-md-3">ABOUT THE BOOK :</th><td colspan="3" class="col-md-3"><?php echo $about_the_book; ?></td></tr>
									<th class="col-md-3">ANY OTHER RELEVANT INFORMATION :</th><td class="col-md-3"><?php echo $other_info; ?></td>
									</tr>
							</table>
					</div>
				  </div>
				  <!--Digitization Status-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Digitization Status</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">DIGITIZED BY :</th><td class="col-md-3">CCRAS-NIIMH<?php //echo $digi_by; ?></td>
									<th class="col-md-3">DIGITIZATION DATE :</th><td class="col-md-3"><?php echo $date_of_digi; ?></td></tr>
								<!--<tr><th class="col-md-3">IMAGE FRONT :</th><td class="col-md-3"><img style="width:80%;height:80pt" src="images/1.png"></img></td>
									<th class="col-md-3">IMAGE BACK :</th><td class="col-md-3"><img style="width:80%;height:80pt" src="images/1.png"></img></td></tr>-->
							</table>
					</div>
				  </div>
				</div>
								
					</div>
				<!--</div>
			</div>-->
			<!--Page Content End-->
                                           
										
		</div>
	</div>
	
	<!-- ======= Manuscript Details Section end ======= -->	
	
	<?= $this->endSection(); ?>
		
		



	

	