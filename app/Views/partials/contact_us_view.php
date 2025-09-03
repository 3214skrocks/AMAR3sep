<?= $this->extend("layouts/base"); ?>
	
	<?= $this->section("content"); ?>
		<!-- About Us Page Content-->
			<!-- Breadcrumb -->
				<div class="bg-light">
					<div class="container">
						<ul class="breadcrumb bg-light pl-0">
							<li><a href="./">Home</a></li>
							<li>Contact Us Page</li>
						</ul>
					</div>
				</div>
			<!-- Breadcrumb End-->

		<!-- Inner body -->
        <div class="mt-4" id="b-inner-sec">
		<div class="container bg-light py-4 b-dbcard">
			<h2 class="table-thead">&nbsp;Contact Us</h2>
			
			<!--Page Content-->
				<!--<div class="mt-4 mb-5" id="b-contact-sec">
					<div class="container">
						<p>
								<h4 class="mt-5"><span>Assistant Director In-Charge</span></h4><br>
								National Institute of Indian Medical Heritage (CCRAS), <br>
								Survey No.314, Revenue Board Colony,<br>
								Gaddiannaram, Hyderabad-500036, <br>
								Telangana, INDIA. <br>
						</p>
					</div>
				</div>-->

                <div class="container">
                    
                        <div class="card-group">
                                <div class="card bg-muted">
                                    <div class="card-body text-center">
                                        <p class="card-text">
                                            <p>
                                                    <h4 class="mt-5"><span>Assistant Director In-Charge</span></h4><br>
                                                    National Institute of Indian Medical Heritage (CCRAS), <br>
                                                    Survey No.314, Revenue Board Colony,<br>
                                                    Gaddiannaram, Hyderabad-500036, <br>
                                                    Telangana, INDIA. <br>
                                            </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="card bg-primary">
                                    <div class="card-body text-center">
                                        <p class="card-text">
                                            <div class="text-center float-none float-sm-left pr-sm-4 pb-3">
                                                <img class=""  src="<?=base_url(); ?>/public/assets/images/inner-img/niimh.png" width="520" height="350" alt="NIIMH, Building">
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                  
                        </div>
                </div>
			<!--Page Content End-->
                                           
										
		</div>
	</div>
			
		<!-- About Us Section End -->

	<?= $this->endSection(); ?>

	