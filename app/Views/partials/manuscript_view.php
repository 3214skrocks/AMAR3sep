<?= $this->extend("layouts/base"); ?>
<?= $this->section("content"); ?>

<?php //print_r($manuscript_data); ?>
<!-- ======= Breadcrumbs ======= -->
<!-- Breadcrumb start-->
<div class="bg-light">
    <div class="container">
        <ul class="breadcrumb bg-light pl-0">
            <li><a href="<?=base_url(); ?>">Home</a></li>
            <li>Manuscript Page</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End-->

<!-- ======= Manuscript Details Section ======= -->
<div class="mt-4" id="b-inner-sec">
    <div class="container bg-light py-4 b-dbcard">
        <h2 class="">Manuscript</h2>

        <!--Page Content-->
        <div class="mb-5">
            <div class="container">

                <div class="mt-3">
                    <div class="titbg"><img style="width:100%;height:120pt"
                            src="<?=base_url(); ?>public/assets/images/1.png"></img></div>
                    <h3 class="text-center">Manuscript</h3>


                    <!--Navigation tabs start-->
                    <ul class="nav nav-tabs nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#srchtitle">Search with Title</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#srchsystem">System/Topic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#srchlang">Language</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="srchtitle" class="container tab-pane active"><br>
                            <!--Manscript Table-->
                            <div class="table-responsive">
                                <?php ?>

                                <?php
							
								if (!empty($manuscript_data)) {
										echo "<table id = 'myTable' class = 'table table-bordered table-striped' style = 'width:100%'>
													<thead class='table-thead'>
													<tr>
														<th>MSS.Id</th>
														<th>AMAR Id</th>
														<th>Title</th>
														<th>Author</th>
														<th>Language</th>
														<th>State</th>
														
													</tr></thead>";
										// output data of each row
										foreach($manuscript_data as $man) {
												echo "<tr><td>".$man->mssid."</td>".
															"<td>".$man->amar_id."</td>".
															"<td><a href='".base_url()."./manuscript_details/".$man->mssid."' target='_blank'>".$man->title_phonetic."</a></td>".
															"<td>".$man->author_phonetic."</td>".
															"<td>".$man->language_name."</td>".
															"<td>".$man->state_name."</td>
														</tr>";
										}
										echo "</table>";
									} else {
										echo "0 results";
									}
							?>
                            </div>
                            <!--Manscript Table End-->
                        </div>
                        <div id="srchsystem" class="container tab-pane fade"><br>
                            <div class="tab-pane p-20" id="messages1" role="tabpanel">
                                <?php 
								//print_r($sysdata); 
								?>
                                <!-- By System Count -->
                                <div class="tab-pane p-20" id="messages1" role="tabpanel">
                                    <div class="row">
                                        <!--Count for Ayurveda-->
                                        <div class="col-md-6 col-lg-2 col-xlg-3">
                                            <a href='./manuscript_system_details/<?= $sys_id_ayu; ?>' target='_blank'>
                                                <div class="card card-hover">
                                                    <div class="box bg-success text-center">
                                                        <h1 class="font-light text-white"><i
                                                                class="fas fa-file-medical"></i></h1>
                                                        <h6 class="text-white">Ayurveda- <?= $sys_count_ayurveda;?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!--Count for Yoga-->
                                        <div class="col-md-6 col-lg-2 col-xlg-3">
                                            <a href='./manuscript_system_details/<?= $sys_id_yoga; ?>' target='_blank'>
                                                <div class="card card-hover">
                                                    <div class="box bg-primary text-center">
                                                        <h1 class="font-light text-white"><i
                                                                class="fas fa-file-medical"></i></h1>
                                                        <h6 class="text-white">Yoga- <?= $sys_count_yoga;?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!--Count for Naturopathy-->
                                        <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
											<div class="card card-hover">
												<div class="box bg-secondary text-center">
													<h1 class="font-light text-white"><i class="fas fa-file-medical"></i></h1>
													<h6 class="text-white">Naturopathy-<?php //= $sys_count_naturopathy;?></h6>
												</div>
											</div>
										</div> -->
                                        <!--Count for Unani-->
                                        <div class="col-md-6 col-lg-2 col-xlg-3">
                                            <div class="card card-hover">
                                                <div class="box bg-danger text-center">
                                                    <h1 class="font-light text-white"><i
                                                            class="fas fa-file-medical"></i></h1>
                                                    <h6 class="text-white">Unani- <?= $sys_count_unani;?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Count for Siddha-->
                                        <div class="col-md-6 col-lg-2 col-xlg-3">
                                            <div class="card card-hover">
                                                <div class="box bg-warning text-center">
                                                    <h1 class="font-light text-white"><i
                                                            class="fas fa-file-medical"></i></h1>
                                                    <h6 class="text-white">Siddha- <?= $sys_count_siddha;?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Count for Homoeo-->
                                        <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
											<div class="card card-hover">
												<div class="box bg-info text-center">
													<h1 class="font-light text-white"><i class="fas fa-file-medical"></i></h1>
													<h6 class="text-white">Homoeopathy- <?php //= $sys_count_homoeopathy;?></h6>
												</div>
											</div>
										</div> -->
                                        <!--Count for Other Systems-->
                                        <div class="col-md-6 col-lg-2 col-xlg-3">
                                            <div class="card card-hover">
                                                <div class="box bg-dark text-center">
                                                    <h1 class="font-light text-white"><i
                                                            class="fas fa-file-medical"></i></h1>
                                                    <h6 class="text-white">Others- <?= $sys_count_others;?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- By System End-->
                            </div>

                        </div>

                        <div id="srchlang" class="container tab-pane fade"><br>
                            <h3>Language</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam.</p>
                        </div>
                    </div>
                    <!-- Tab panes end-->
                    <!--Navigation tabs end-->

                    <div class="table-responsive">
                        <?php //print_r($mss_system_data); ?>

                        <?php
							
								if (!empty($mss_system_data)) {
										echo "<table id = 'myTable' class = 'table table-bordered table-striped' style = 'width:100%'>
													<thead class='table-thead'>
													<tr>
														<th>MSS.Id</th>
														<th>AMAR Id</th>
														<th>Title</th>
														<th>Author</th>
														<th>Language</th>
														<th>State</th>
														
													</tr></thead>";
										// output data of each row
										foreach($mss_system_data as $man) {
												echo "<tr><td>".$man->mssid."</td>".
															"<td>".$man->amar_id."</td>".
															"<td><a href='".base_url()."./manuscript_details/".$man->mssid."' target='_blank'>".$man->title_phonetic."</a></td>".
															"<td>".$man->author_phonetic."</td>".
															"<td>".$man->language_name."</td>".
															"<td>".$man->state_name."</td>
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