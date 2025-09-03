    <?= $this->extend("layouts/base"); ?>
    <?= $this->section("content"); ?>


    <!-- ======= Breadcrumbs ======= -->
    <!-- Breadcrumb start-->
    <div class="bg-light">
        <div class="container">
            <ul class="breadcrumb bg-light pl-0">
                <li><a href="<?=base_url(); ?>">Home</a></li>
                <li><a href="<?=base_url(); ?>catalogue">Catalogues</a></li>
                <li>Catalogue Details</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End-->
    <?php //print_r($cat_data); ?>
    <?php						
						if (!empty($cat_data)) {
								foreach($cat_data as $cat) {
								
									//Introductory
										$cat_id=$cat->cat_id;
										$amar_id=$cat->amar_id;
										//Technical
										$title_phonetic=$cat->title_phonetic;
										$author_phonetic=$cat->author_phonetic;
										$ayush_system=$cat->ayush_system;
										$subject=$cat->subject;
										$language=$cat->language;
										$script=$cat->script;
										//Textual
										$material=$cat->material;
										$time_period=$cat->time_period;
										$extent=$cat->extent;
										$physical_location=$cat->physical_location;
										//$place_and_state=$cat->place_and_state;
										$accession_no=$cat->accession_no;
										$contact_address=$cat->contact_address;
										//Catalogue
										$cat_public_status=$cat->cat_public_status;
										//bibliography
										$bibliography_references=$cat->bibliography_references;	
							  }
						} else {
							echo "0 results";
						}
						
			?>

    <!-- ======= Catalogue Details Section start ======= -->
    <div class="mt-4" id="b-inner-sec">
        <div class="container bg-light py-4 b-dbcard manbg1" style="">
            <h2 class="">Catalogue</h2>

            <!--Page Content-->
            <!--<div class="mb-5">
				<div class="container">-->

            <div class="mt-2">

                <div class="titbg"><img style="width:100%;height:100pt"
                        src="<?=base_url(); ?>public/assets/images/cat_sml.png"></img></div>

                <h3 class="text-center mt-2 h3title"><?php echo $title_phonetic; ?></h3>
                <div class="row">
                    <!--Introductory-->
                    <div class="col-md-12">
                        <h4 class="text-left h4title table-thead">&nbsp;Introductory</h4>
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th class="col-md-3">S.NO :</th>
                                    <td class="col-md-3"><?php echo $cat_id; ?></td>
                                    <th class="col-md-3">AMAR ID :</th>
                                    <td class="col-md-3"><?php echo $amar_id; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--Technical-->
                    <div class="col-md-12">
                        <h4 class="text-left h4title table-thead">&nbsp;Technical</h4>
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th class="col-md-3">TITLE :</th>
                                    <td class="col-md-3"><?php echo $title_phonetic ?></td>
                                    <th class="col-md-3">AUTHOR :</th>
                                    <td class="col-md-3"><?php echo $author_phonetic; ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-3">AYUSH SYSTEM :</th>
                                    <td class="col-md-3"><?php echo $ayush_system; ?></td>
                                    <th class="col-md-3">SUBJECT:</th>
                                    <td class="col-md-3"><?php echo $subject; ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-3">LANGUAGE :</th>
                                    <td class="col-md-3"><?php echo $language; ?></td>
                                    <th class="col-md-3">SCRIPT :</th>
                                    <td class="col-md-3"><?php echo $script; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--Textual-->
                    <div class="col-md-12">
                        <h4 class="text-left h4title table-thead">&nbsp;Textual</h4>
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th class="col-md-3">MATERIAL:</th>
                                    <td class="col-md-3"><?php echo $material; ?></td>
                                    <th class="col-md-3">TIME PERIOD :</th>
                                    <td class="col-md-3"><?php echo $time_period; ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-3">EXTENT :</th>
                                    <td class="col-md-3"><?php echo $extent; ?></td>
                                    <th class="col-md-3">PHYSICAL LOCATION :</th>
                                    <td class="col-md-3"><?php echo $physical_location; ?></td>
                                </tr>
                                <tr>
                                    <th class="col-md-3">ACCESSION NO :</th>
                                    <td class="col-md-3"><?php echo $accession_no; ?></td>
                                    <th class="col-md-3">CONTACT ADDRESS :</th>
                                    <td class="col-md-3"><?php echo $contact_address; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!--Catalogue-->
                    <div class="col-md-12">
                        <h4 class="text-left h4title table-thead">&nbsp;Catalogue</h4>
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th class="col-md-3">CATALOGUE PUBLICATION STATUS:</th>
                                    <td class="col-md-3"><?php echo $cat_public_status; ?></td>
                            </table>
                        </div>
                    </div>
                    <!--Bibliography-->
                    <div class="col-md-12">
                        <h4 class="text-left h4title table-thead">&nbsp;Bibliography</h4>
                        <div class="table-responsive">
                            <table id="myTable1" class="table table-bordered table-striped" style="width:100%">
                                <th class="col-md-3">References :</th>
                                <td class="col-md-3"><?php echo $bibliography_references; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <!--</div>
			</div>-->
                <!--Page Content End-->


            </div>
        </div>
    </div>


    <!-- ======= Manuscript Details Section end ======= -->

    <?= $this->endSection(); ?>