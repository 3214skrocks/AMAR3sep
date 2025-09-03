    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	
				
	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li><a href="<?=base_url(); ?>periodicals">Periodicals</a></li>
					<li>Periodical Details</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	<?php //print_r($per_data); ?>
		<?php						
						if (!empty($per_data)) {
								foreach($per_data as $per) {
								
									//Periodical Info
									$per_id=$per->per_id;
									$amar_id=$per->amar_id;
									$access_no=$per->access_no;
									$source_location=$per->source_location;
									//Technical
									$per_title=$per->per_title;
									$country_of_publication=$per->country_of_publication;
									$publisher=$per->publisher;
									$editor=$per->editor;
									$publication_start_year=$per->publication_start_year;
									$place_of_publishers=$per->place_of_publishers;
									$frequency=$per->frequency;
									$language=$per->language;
									$broad_subject_term=$per->broad_subject_term;
									//Artical
									$article_id=$per->article_id;
									$title_of_article=$per->title_of_article;
									$authors=$per->authors;
									$name_of_the_journal=$per->name_of_the_journal;
									$year=$per->year;
									$volume=$per->volume;
									$issue=$per->issue;
									$page_no=$per->page_no;
									$key_words=$per->key_words;
									$broad_subject=$per->broad_subject;
									$category=$per->category;
									$language_of_the_article=$per->language_of_the_article;
									$abstract=$per->abstract;
							  }
						} else {
							echo "0 results";
						}
						
			?>
	
	<!-- ======= Periodical Details Section start ======= -->

				<div class="mt-4" id="b-inner-sec">
					<div class="container bg-light py-4 b-dbcard manbg1" style="">
						<h2 class="">Periodical</h2>
						
						<!--Page Content-->
							<!--<div class="mb-5">
							<div class="container">-->

							<div class="mt-2">
							
							<div class="titbg"><img style="width:100%;height:100pt" src="<?=base_url(); ?>public/assets/images/periodicals_sml.png"></img></div>
							
							<h3 class="text-center mt-2 h3title"><?php echo $per_title; ?></h3>
							<div class="row">
							<!--Introductory-->
							  <div class="col-md-12">
								<h4 class="text-left h4title table-thead">&nbsp;Introductory</h4>
								<div class="table-responsive">
										<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
											<tr><th class="col-md-3">S.NO :</th><td class="col-md-3"><?php echo $per_id; ?></td>
												<th class="col-md-3">AMAR ID :</th><td class="col-md-3"><?php echo $amar_id; ?></td></tr>
											<tr><th class="col-md-3">ACCESSION NO. :</th><td class="col-md-3"><?php echo $access_no; ?></td>
												<th class="col-md-3">SOURCE LOCATION :</th><td class="col-md-3"><?php echo $source_location; ?></td></tr>
										</table>
								</div>
							  </div>
							  <!--Technical-->
							  <div class="col-md-12">
								<h4 class="text-left h4title table-thead">&nbsp;Technical</h4>
								<div class="table-responsive">
										<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
											<tr><th colspan="1" class="col-md-2">PERIODICAL'S TITLE :</th><td colspan="3" class="col-md-10"><?php echo $per_title; ?></td></tr>
											<tr><th class="col-md-3">COUNTRY OF PUBLICATION :</th><td class="col-md-3"><?php echo $country_of_publication; ?></td>
												<th class="col-md-3">PUBLISHER:</th><td class="col-md-3"><?php echo $publisher; ?></td></tr>
											<tr><th class="col-md-3">EDITOR :</th><td class="col-md-3"><?php echo $editor; ?></td>
												<th class="col-md-3">PUBLICATION START YEAR :</th><td class="col-md-3"><?php echo $publication_start_year; ?></td></tr>
											<tr><th class="col-md-3">PLACE OF PUBLISHERS:</th><td class="col-md-3"><?php echo $place_of_publishers; ?></td>
												<th class="col-md-3">FREQUENCY :</th><td class="col-md-3"><?php echo $frequency; ?></td></tr>
											<tr><th class="col-md-3">LANGUAGE :</th><td class="col-md-3"><?php echo $language; ?></td>
												<th class="col-md-3">BROAD SUBJECT TERM :</th><td class="col-md-3"><?php echo $broad_subject_term; ?></td></tr>
											</table>
								</div>
							  </div>
							  <!--Artical Information-->
							  <div class="col-md-12">
								<h4 class="text-left h4title table-thead">&nbsp;Article</h4>
								<div class="table-responsive">
										<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
											<tr><th colspan="1" class="col-md-1">ARTICLE ID : <?php echo $article_id; ?></th>
												<th class="col-md-2">TITLE OF ARTICLE :</th><td colspan="2" class="col-md-8"><?php echo $title_of_article; ?></td></tr>
											<tr><th class="col-md-3">AUTHOR(S) :</th><td class="col-md-3"><?php echo $authors; ?></td>
												<th class="col-md-3">NAME OF THE JOURNAL :</th><td class="col-md-3"><?php echo $name_of_the_journal; ?></td></tr>
											<tr><th class="col-md-3">YEAR :</th><td class="col-md-3"><?php echo $year; ?></td>
												<th class="col-md-3">VOLUME :</th><td class="col-md-3"><?php echo $volume; ?></td></tr>
											<tr><th class="col-md-3">ISSUE :</th><td class="col-md-3"><?php echo $issue; ?></td>
												<th class="col-md-3">PAGE NO :</th><td class="col-md-3"><?php echo $page_no; ?></td></tr>
											<tr><th class="col-md-3">KEY WORDS :</th><td class="col-md-3"><?php echo $key_words; ?></td>	
												<th class="col-md-3">BROAD SUBJECT :</th><td class="col-md-3"><?php echo $broad_subject; ?></td></tr>
											<tr><th class="col-md-3">CATEGORY :</th><td class="col-md-3"><?php echo $category; ?></td>
												<th class="col-md-3">LANGUAGE OF THE ARTICLE :</th><td class="col-md-3"><?php echo $language_of_the_article; ?></td></tr>
											<tr><th class="col-md-3">ABSTRACT :</th><td colspan="3" class="col-md-3"><?php echo $abstract; ?></td>
											</tr>
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
	<!-- ======= Periodical Details Section end ======= -->	
	
	<?= $this->endSection(); ?>
		
		



	

	