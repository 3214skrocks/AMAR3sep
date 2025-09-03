    <?= $this->extend("layouts/base"); ?>
	
	<?= $this->section("content"); ?>
		<!-- Home Page Content-->
			<div class="container bg-light py-4 b-dbcard ">
			<!-- Banner -->
			<div id="demo" class="carousel slide" data-ride="carousel">
				<ul class="carousel-indicators">
					<li data-target="#demo" data-slide-to="0" class="active"></li>
					<li data-target="#demo" data-slide-to="1"></li>
					<li data-target="#demo" data-slide-to="2"></li>
					<li data-target="#demo" data-slide-to="3"></li>
				</ul>
				<div class="carousel-inner" align="center">
					<div class="carousel-item active">
						<img src="<?=base_url(); ?>/public/assets/images/banner/1man-banner.png" alt="banner 1" width="100%" height="350px">
						<!-- <div class="carousel-caption" style="color:#343A40;">
							<h3>Heading 1</h3>
							<p>Description goes here.</p>
						</div>  <img src="images/banner1.jpg" alt="banner 1" width="67%" height="350px">-->  
					</div>
					<div class="carousel-item">
						<img src="<?=base_url(); ?>/public/assets/images/banner/2book-banner.png" alt="Banner 2" width="100%" height="350px">
						<!-- <div class="carousel-caption" style="color:#343A40;">
							<h3>Heading 2</h3>
							<p>Description goes here.</p>
						</div>  -->
					</div>
					<div class="carousel-item">
						<img src="<?=base_url(); ?>/public/assets/images/banner/3cat-banner.png" alt="Banner 3" width="100%" height="350px">
						<!-- <div class="carousel-caption" style="color:#343A40;">
							<h3>Heading 3</h3>
							<p>Description goes here.</p>
						</div>   -->
					</div>
					<div class="carousel-item">
						<img src="<?=base_url(); ?>/public/assets/images/banner/4per-banner.png" alt="Banner 4" width="100%" height="350px">
						<!-- <div class="carousel-caption" style="color:#343A40;">
							<h3>Heading 3</h3>
							<p>Description goes here.</p>
						</div>   -->
					</div>
				</div>
				<a class="carousel-control-prev" href="#demo" data-slide="prev">
					<span style="display:none;">Previous</span>
					<span class="far fa-angle-left" style="font-size:40px; color:#fff"></span>
				</a>
				<a class="carousel-control-next" href="#demo" data-slide="next">
					<span style="display:none;">Next</span>
					<span class="far fa-angle-right" style="font-size:40px; color:#fff"></span>
				</a>
			</div>
			<!-- Banner End-->

			<!-- Dashboard -->
			<hr>
			<div class="my-5" id="b-homedb">
				<div class="container ">
					<div class="row text-center">
						<h2 class="col-md-12 table-thead">AMAR Repositories </h2>
						<div class="col-lg-3 p-4">
							<div class="bg-light py-4 b-dbcard cardhover homecard">
								<p><img src="<?=base_url(); ?>/public/assets/images/gallery/man_img1.png" class="minhomecard" alt="Manuscripts" width="90%" height="100px"></p>
								<h3 class="" style=""><strong>Manuscripts</strong></h3>
								<div class="text-center ">
									<h3 class="px-6">Total-<span class="float-center">4249</span></h3>
									<!--<h4 class="mt-5"><span>1000</span></h4>-->
									<!--<p class="px-5">Current year <span class="float-right">9,478.75 Cr</span></p>-->
								</div>
								<div class="text-center py-4">
									<a href="manuscript"><button type="submit" class="btn btn-primary b-btn">Read More</button></a>
								</div>
								
							</div>
							
						</div>
						<div class="col-lg-3 p-4 ">
							<div class="bg-light py-4 b-dbcard cardhover homecard">
								<p><img src="<?=base_url(); ?>/public/assets/images/gallery/5.png" class="minhomecard" alt="Rare books" width="90%" height="100px"></p>
								<h3 class="" style=""><strong>Rare books</strong></h3>
								<div class="text-center ">
									<h3 class="px-6">Total-<span class="float-center">1224</span></h3>
									<!--<h4 class="mt-5"><span>1000</span></h4>-->
									<!--<p class="px-5">Current year <span class="float-right">9,478.75 Cr</span></p>-->
								</div>
								<div class="text-center py-4">
									<a href="rarebook"><button type="submit" class="btn btn-primary b-btn">Read More</button></a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 p-4">
							<div class="bg-light py-4 b-dbcard cardhover homecard">
								<p><img src="<?=base_url(); ?>/public/assets/images/gallery/Cat_img1.png" class="minhomecard" alt="Catalogues" width="90%" height="100px"></p>
								<h3 class="" style=""><strong>Catalogues</strong></h3>
								<div class="text-center ">
									<h3 class="px-6">Total-<span class="float-center">14126</span></h3>
									<!--<h4 class="mt-5"><span>1000</span></h4>-->
									<!--<p class="px-5">Current year <span class="float-right">9,478.75 Cr</span></p>-->
								</div>
								<div class="text-center py-4">
									<a href="catalogue"><button type="submit" class="btn btn-primary b-btn">Read More</button></a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 p-4">
							<div class="bg-light py-4 b-dbcard cardhover homecard">
								<p><img src="<?=base_url(); ?>/public/assets/images/gallery/per_img2.png" class="minhomecard" alt="Periodicals" width="90%" height="100px"></p>
								<h3 class="" style=""><strong>Periodicals</strong></h3>
								<div class="text-center ">
									<h3 class="px-6">Total-<span class="float-center">4144</span></h3>
									<!--<h4 class="mt-5"><span>1000</span></h4>-->
									<!--<p class="px-5">Current year <span class="float-right">9,478.75 Cr</span></p>-->
								</div>
								<div class="text-center py-4">
									<a href="periodicals"><button type="submit" class="btn btn-primary b-btn">Read More</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<!-- About AMAR-->
			<div class="mb-5">
				<div class="container">
					<div class="mt-5">
							<h3 class="text-center table-thead"><span>About AMAR</span></h3>
							<div class="text-center float-none float-sm-left pr-sm-4 pb-3">
								<img class=""  src="<?=base_url(); ?>/public/assets/images/inner-img/niimh.png" width="275" height="200" alt="Second Example picture">
							</div>
							
							<p>AMAR - Ayush Manuscript Advanced Repository, a dedicated platform providing single point accesses to comprehensive metadata of Manuscripts, Rare books, Catalogues and old and rare periodicals of Ayurveda, Yoga & Naturopathy, Unani, Siddha, Sowa Rigpa and Homoeopathy Medical Systems.</p>
							<p>AMAR designed and maintained at CCRAS - National Institute of Indian Medical Heritage(NIIMH), Hyderabad a nodal Institute for Literary Research and Medico - historical studies in Ayush Systems, Biomedicine and World medicine.The prime area of focus is to revive, retrieve rich medical and cultural heritage of India to posterity and to publication for wider dissemination and global readership.</p>
					</div>
				</div>
			</div>
			</div>
			
			<!-- Gallery Section -->
			<div class="b-gallerysec my-0 py-4">
				<div class="container">
					<div class="row">
						<div class="col-xl-9">
							<h3 class="text-white">Manuscript Collections</h3>
							<div class="owl-carousel owl-theme img-gallery">
							<div class="item text-center">
								<img src="<?=base_url(); ?>/public/assets/images/gallery/1.png">
								<div class="carousel-caption">
								  <h3>Manuscript</h3>
								  <p>Donar Details</p>
								</div>
							</div>
							<div class="item text-center">
								<img src="<?=base_url(); ?>/public/assets/images/gallery/2.png">
								<div class="carousel-caption">
								  <h3>Manuscript</h3>
								  <p>Donar Details</p>
								</div>
							</div>
							<div class="item text-center">
								<img src="<?=base_url(); ?>/public/assets/images/gallery/1.png">
								<div class="carousel-caption">
								  <h3>Manuscript</h3>
								  <p>Donar Details</p>
								</div>
							</div>
							<div class="item text-center">
								<img src="<?=base_url(); ?>/public/assets/images/gallery/2.png">
								<div class="carousel-caption">
								  <h3>Manuscript</h3>
								  <p>Donar Details</p>
								</div>
							</div>
							<div class="item text-center">
								<img src="<?=base_url(); ?>/public/assets/images/gallery/1.png">
								<div class="carousel-caption">
								  <h3>Manuscript</h3>
								  <p>Donar Details</p>
								</div>
							</div>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="h-100">
								<h3 class="text-white">NIIMH Web Links</h3>
								<div class="bg-light b-minbook" style="height: 399.8px">
									<div class="p-3 pt-4">
										<div>
											<h5>Web Portals</h5>
											<ul>
												<li><a href="https://ayushportal.nic.in" target="_blank">Ayushportal</a></li>
												<li><a href="https://namstp.ayush.gov.in" target="_blank">NAMASTE Portal</a></li>
												<li><a href="https://niimh.nic.in/sahi" target="_blank">SAHI Portal</a></li>
												<li><a href="https://eg4.nic.in/MedicalLibraries/OPAC/Default.aspx?LIB_CODE=NCIMH" target="_blank">e-MEDHA Catalogue</a></li>
												<li><a href="https://rmis.nic.in" target="_blank">RMIS Portal</a></li>
											</ul>
										</div>
										<div>
											<h5>e-Books</h5>
											<ul>
												<li><a href="https://niimh.nic.in">NIIMH Site</a></li>
												<!--<li><a href="inner.html">eBook2 name goes here (pdf file)</a></li>-->
											</ul>
										</div>
										<div class="text-center mt-4">
											<button class="btn btn-primary b-btn" style="">Read More </button>
										</div>
										
									</div>
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- Gallery Section End-->
	
		<!-- Home Section End -->

	<?= $this->endSection(); ?>

	