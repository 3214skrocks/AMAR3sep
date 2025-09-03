    <?= $this->extend("layouts/base"); ?>
	<?= $this->section("content"); ?>
	
				
	 <!-- ======= Breadcrumbs ======= -->
		<!-- Breadcrumb start-->
		<div class="bg-light">
			<div class="container">
				<ul class="breadcrumb bg-light pl-0">
					<li><a href="<?=base_url(); ?>">Home</a></li>
					<li><a href="<?=base_url(); ?>manuscript">Manuscripts</a></li>
					<li>Manuscript Details</li>
				</ul>
			</div>
		</div>
	<!-- Breadcrumb End-->
	<?php //print_r($mss_data); ?>
		<?php
				
						
						if (!empty($mss_data)) {
								foreach($mss_data as $mss) {
								
								//Introductory
									$mss_id=$mss->mssid;
									$amar_id=$mss->amar_id;
									$title_unic=$mss->title_unic;
									$title_phonetic=$mss->title_phonetic;
									$source_name=$mss->source_name;
									$state_name=$mss->state_name;
									$accession_no=$mss->accession_no;
									$accession_no_at_source=$mss->accession_no_at_source;
									//Technical
									$other_title=$mss->other_title;
									$other_title_diacritical=$mss->other_title_diacritical;
									$author_unic=$mss->author_unic;
									$author_phonetic=$mss->author_phonetic;
									$co_author=$mss->co_author;
									$redactor=$mss->redactor;
									$commentator_diacritical=$mss->commentator_diacritical;
									$name_of_the_commentary=$mss->name_of_the_commentary;
									$author_date=$mss->author_date;
									$commentator_date=$mss->commentator_date;
									$topic_name=$mss->topic_name;
									$subject_name=$mss->subject_name;
									$language_name=$mss->language_name;
									$script_name=$mss->script_name;
									$scribe=$mss->scribe;
									$scribe_date_and_place=$mss->scribe_date_and_place;
									//Textual
									$abs_unic=$mss->authors_beginning_sentence_unic;
									$abs_dia=$mss->authors_beginning_sentence_diacritical;
									$sbs_unic=$mss->scribes_beginning_sentence_unic;
									$sbs_dia=$mss->scribes_beginning_sentence_diacritical;
									$aes_unic=$mss->authors_ending_sentence_unic;
									$aes_dia=$mss->authors_ending_sentence_diacritical;
									$ses_unic=$mss->scribes_ending_sentence_unic;
									$ses_dia=$mss->scribes_ending_sentence_diacritical;
									$col_unic=$mss->colophon_unic;
									$col_dia=$mss->colophon_diacritical;
									$chapter=$mss->chapterisation;
									$extent=$mss->completeness;
									$remarks=$mss->remarks;
									//Textual
									$material_name=$mss->material_name;
									$length=$mss->length;
									$width=$mss->width;
									$unit=$mss->unit;
									$no_of_folios=$mss->no_of_folios;
									$no_of_pages=$mss->no_of_pages;
									$no_of_lines_per_folio=$mss->no_of_lines_per_folio;
									$no_of_lines_per_page=$mss->no_of_lines_per_page;
									$no_of_letters_per_line=$mss->no_of_letters_per_line;
									$granthamana=$mss->granthamana;
									$missing_folios=$mss->missing_folios;
									$illustrations=$mss->illustrations;
									$condition=$mss->condition;
									//Catalogue
									$cat_status=$mss->cat_status;
									$cat_mss_no=$mss->cat_mss_no;
									$cat_title=$mss->cat_title;
									$cat_part=$mss->cat_part;
									$cat_volume=$mss->cat_volume;
									$cat_editor=$mss->cat_editor;
									$cat_publisher=$mss->cat_publisher;
									$cat_yop=$mss->cat_yop;
									$cat_add_details=$mss->cat_add_details;
									//Publication Details
									$publication_status=$mss->publication_status;
									$public_language=$mss->public_language;
									$public_availability=$mss->public_availability;
									$public_editor=$mss->public_editor;
									$public_translator=$mss->public_translator;
									$public_publisher=$mss->public_publisher;
									$public_yop=$mss->public_yop;
									$public_place=$mss->public_place;
									$about_the_book=$mss->about_the_book;
									//Digitization Status
									$compiled_by=$mss->compiled_by;
									$date_of_collection=$mss->date_of_collection;
							  }
						} else {
							echo "0 results";
						}
						
			?>
	
	<!-- ======= Manuscript Details Section start ======= -->
	<div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard manbg1" style="">
			<h2 class="">Manuscripts</h2>
			
			<!--Page Content-->
				<!--<div class="mb-5">
				<div class="container">-->

				<div class="mt-2">
				
				<div class="titbg"><img style="width:100%;height:100pt" src="<?=base_url(); ?>public/assets/images/1.png"></img></div>
				
				<h3 class="text-center mt-2 h3title"><?php echo $title_phonetic; ?></h3>
				<div class="row">
				<!--Introductory-->
				  <div class="col-md-12">
				  	<h4 class="text-left h4title table-thead">&nbsp;Introductory</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">S.NO :</th><td class="col-md-3"><?php echo $mss_id; ?></td>
									<th class="col-md-3">AMAR ID :</th><td class="col-md-3"><?php echo $amar_id; ?></td></tr>
								<tr><th class="col-md-3">TITLE OF THE MANUSCRIPT :</th><td class="col-md-3"><?php echo $title_phonetic;; ?></td>
									<th class="col-md-3">SOURCE LOCATION :</th><td class="col-md-3"><?php echo $source_name; ?></td></tr>
								<tr><th class="col-md-3">PLACE & STATE :</th><td class="col-md-3"><?php echo $state_name; ?></td>
									<th class="col-md-3">ACCESSION NO. AT SOURCE :</th><td class="col-md-3"><?php echo $accession_no_at_source; ?></td></tr>
								<tr><th class="col-md-3">ACCESSION NO.AT NIIMH, HYDERBAD :</th><td class="col-md-3"><?php echo $accession_no; ?></td></tr>
							</table>
					</div>
				  </div>
				  <!--Technical-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Technical</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">OTHER TITLE :</th><td class="col-md-3"><?php echo $other_title."/". $other_title_diacritical?></td>
									<th class="col-md-3">AUTHOR NAME :</th><td class="col-md-3"><?php echo $author_unic."/". $author_phonetic; ?></td></tr>
								<tr><th class="col-md-3">CO-AUTHOR NAME  :</th><td class="col-md-3"><?php echo $co_author; ?></td>
									<th class="col-md-3">REDACTOR'S NAME :</th><td class="col-md-3"><?php echo $redactor; ?></td></tr>
								<tr><th class="col-md-3">COMMENTATOR NAME  :</th><td class="col-md-3"><?php echo $commentator_diacritical; ?></td>
									<th class="col-md-3">NAME OF THE COMMENTARY :</th><td class="col-md-3"><?php echo $name_of_the_commentary; ?></td></tr>
								<tr><th class="col-md-3">LANGUAGE OF THE COMMENTATOR:</th><td class="col-md-3"><?php //echo $state; ?></td>
									<th class="col-md-3">AUTHOR DATE :</th><td class="col-md-3"><?php echo $author_date; ?></td></tr>
								<tr><th class="col-md-3">COMMENTATOR DATE :</th><td class="col-md-3"><?php echo $commentator_date ?></td>
									<th class="col-md-3">SCRIBE :</th><td class="col-md-3"><?php echo $scribe; ?></td></tr>
								<tr><th class="col-md-3">SCRIBE DATE AND PLACE :</th><td class="col-md-3"><?php echo $scribe_date_and_place; ?></td>
									<th class="col-md-3">AYUSH SYSTEM :</th><td class="col-md-3"><?php echo $topic_name; ?></td></tr>
								<tr><th class="col-md-3">SUBJECT:</th><td class="col-md-3"><?php echo $subject_name; ?></td>
									<th class="col-md-3">LANGUAGE :</th><td class="col-md-3"><?php echo $language_name; ?></td></tr>
								<tr><th class="col-md-3">SCRIPT :</th><td class="col-md-3"><?php echo $script_name; ?></td></tr>
							</table>
					</div>
				  </div>
				  <!--Textual-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Textual</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th colspan="1" class="col-md-2">AUTHOR'S BEGINNING SENTENCE (UNICODE)/(DIACRITICAL) :</th><td colspan="3" class="col-md-10"><?php echo $abs_unic."/".$abs_dia; ?></td></tr>
								<tr><th colspan="1" class="col-md-2">SCRIBE'S BEGINNING SENTENCE (UNICODE)/(DIACRITICAL) :</th><td colspan="3" class="col-md-10"><?php echo $sbs_unic."/".$sbs_dia; ?></td></tr>
								<tr><th colspan="1" class="col-md-2">AUTHOR'S ENDING SENTENCE (UNICODE)/(DIACRITICAL) :</th><td colspan="3" class="col-md-10"><?php echo $aes_unic."/".$aes_dia; ?></td></tr>
								<tr><th colspan="1" class="col-md-2">SCRIBES ENDING SENTENCE (UNICODE)/(DIACRITICAL) :</th><td colspan="3" class="col-md-10"><?php echo $ses_unic."/".$ses_dia; ?></td></tr>
								<tr><th class="col-md-3">COLOPHON (UNICODE)/(DIACRITICAL) :</th><td class="col-md-3"><?php echo $col_unic."/".$col_dia; ?></td>
									<th class="col-md-3">CHAPERTIZATION:</th><td class="col-md-3"><?php echo $chapter; ?></td></tr>
								<tr><th class="col-md-3">EXTENT :</th><td class="col-md-3"><?php echo $extent; ?></td></tr>
								<tr><th colspan="1" class="col-md-2">REMARKS :</th><td colspan="3" class="col-md-10"><?php echo $remarks; ?></td></tr>
							</table>
					</div>
				  </div>
				  <!--Physical-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Physical</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">MATERIAL :</th><td class="col-md-3"><?php echo $material_name; ?></td>
									<th class="col-md-3">SIZE :</th><td class="col-md-3"><?php echo $length." ".$width."".$unit; ?></td></tr>
								<tr><th class="col-md-3">No. of FOLIOS :</th><td class="col-md-3"><?php echo $no_of_folios; ?></td>
									<th class="col-md-3">No. of PAGES :</th><td class="col-md-3"><?php echo $no_of_pages; ?></td></tr>
								<tr><th class="col-md-3">No. of LINES PER FOLIOS :</th><td class="col-md-3"><?php echo $no_of_lines_per_folio; ?></td>
									<th class="col-md-3">No. of LINES PER PAGE:</th><td class="col-md-3"><?php echo $no_of_lines_per_page; ?></td></tr>
								<tr><th class="col-md-3">No. of LETTERS PER LINE :</th><td class="col-md-3"><?php echo $no_of_letters_per_line; ?></td>
									<th class="col-md-3">GRANTHAMANA :</th><td class="col-md-3"><?php echo $granthamana; ?></td></tr>
								<tr><th class="col-md-3">MISSING FOLIOS :</th><td class="col-md-3"><?php echo $missing_folios; ?></td>
									<th class="col-md-3">ILLUSTRATIONS :</th><td class="col-md-3"><?php echo $illustrations; ?></td></tr>
								<tr><th class="col-md-3">CONDITION :</th><td class="col-md-3"><?php echo $condition; ?></td></tr>
							</table>
					</div>
				  </div>
				  <!--Catalogue-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Catalogue</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">CATALOGUE STATUS :</th><td class="col-md-3"><?php echo $cat_status; ?></td>
									<th class="col-md-3">CATALOGUE MSS.NUMBER :</th><td class="col-md-3"><?php echo $cat_mss_no; ?></td></tr>
								<tr><th class="col-md-3">CATALOGUE TITLE :</th><td class="col-md-3"><?php echo $cat_title; ?></td>
									<th class="col-md-3">CATALOGUE PART :</th><td class="col-md-3"><?php echo $cat_part; ?></td></tr>
								<tr><th class="col-md-3">CATALOGUE VOLUME :</th><td class="col-md-3"><?php echo $cat_volume; ?></td>
									<th class="col-md-3">CATALOGUE EDITOR:</th><td class="col-md-3"><?php echo $cat_editor; ?></td></tr>
								<tr><th class="col-md-3">CATALOGUE PUBLISHER :</th><td class="col-md-3"><?php echo $cat_publisher; ?></td>
									<th class="col-md-3">CATALOGUE YEAR OF PUBLICATION :</th><td class="col-md-3"><?php echo $cat_yop; ?></td></tr>
								<tr><th class="col-md-3">CATALOGUE ADDITIONAL DETAILS :</th><td class="col-md-3"><?php echo $cat_add_details; ?></td></tr>
							</table>
					</div>
				  </div>
				  <!--Publication Details-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Publication Details</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">PUBLICATION STATUS :</th><td class="col-md-3"><?php echo $publication_status; ?></td>
									<th class="col-md-3">PUBLICATION LANGUAGE :</th><td class="col-md-3"><?php echo $public_language; ?></td></tr>
								<tr><th class="col-md-3">PUBLICATION AVAILABILITY :</th><td class="col-md-3"><?php echo $public_availability; ?></td>
									<th class="col-md-3">PUBLICATION EDITOR :</th><td class="col-md-3"><?php echo $public_editor; ?></td></tr>
								<tr><th class="col-md-3">PUBLICATION TRANSLATOR :</th><td class="col-md-3"><?php echo $public_translator; ?></td>
									<th class="col-md-3">PUBLICATION PUBLISHER:</th><td class="col-md-3"><?php echo $public_publisher; ?></td></tr>
								<tr><th class="col-md-3">PUBLICATION YEAR:</th><td class="col-md-3"><?php echo $public_yop; ?></td>
									<th class="col-md-3">PUBLICATION PLACE :</th><td class="col-md-3"><?php echo $public_place; ?></td></tr>
								<tr><th colspan="1" class="col-md-2">ABOUT MANUSCRIPT :</th><td colspan="3" class="col-md-10"><?php echo $about_the_book; ?></td>
									</tr>
							</table>
					</div>
				  </div>
				  <!--Digitization Status-->
				  <div class="col-md-12">
					<h4 class="text-left h4title table-thead">&nbsp;Digitization Status</h4>
					<div class="table-responsive">
							<table id = "myTable1" class ="table table-bordered table-striped" style = "width:100%">
								<tr><th class="col-md-3">DIGITIZED BY :</th><td class="col-md-3">CCRAS-NIIMH<?php //echo $compiled_by; ?></td>
									<th class="col-md-3">DIGITIZATION DATE :</th><td class="col-md-3"><?php echo $date_of_collection; ?></td></tr>
								<!--<tr><th class="col-md-3">IMAGE FRONT :</th><td class="col-md-3"><img style="width:80%;height:80pt" src="<?=base_url(); ?>public/assets/images/1.png"></img></td>
									<th class="col-md-3">IMAGE BACK :</th><td class="col-md-3"><img style="width:80%;height:80pt" src="<?=base_url(); ?>public/assets/images/1.png"></img></td></tr>-->
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
		
		



	

	