<?php require_once( "../resources/functions.php"); ?>
<?php include( TEMPLATES . "/header.php"); ?>
	<!-- header -->
	<!-- photos -->
	<div class="photos">
	<div class="container">
		<h2>photos</h2>
			<div class="portfolio">
					<div id="portfoliolist">
					<?php get_images_in_gallary();?>
					
					<!-- <div class="portfolio card mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="card" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/2.jpg" class="swipebox"  title="Image Title"> <img src="images/2.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>				
					<div class="portfolio app mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="app" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/3.jpg" class="swipebox"  title="Image Title"> <img src="images/3.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>					
					<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/4.jpg" class="swipebox"  title="Image Title"> <img src="images/4.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>
					<div class="portfolio app mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="app" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/5.jpg" class="swipebox"  title="Image Title"> <img src="images/5.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>			
					<div class="portfolio card mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="card" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/6.jpg" class="swipebox"  title="Image Title"> <img src="images/6.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>	
					<div class="portfolio card mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="card" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/7.jpg" class="swipebox"  title="Image Title"> <img src="images/7.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>	
					<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/8.jpg" class="swipebox"  title="Image Title"> <img src="images/8.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
						</div>
						<div class="portfolio logos mix_all wow bounceIn" data-wow-delay="0.4s" data-cat="logos" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/9.jpg" class="swipebox"  title="Image Title"> <img src="images/9.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
					</div>
					<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/10.jpg" class="swipebox"  title="Image Title"> <img src="images/10.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
						</div>
						<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/11.jpg" class="swipebox"  title="Image Title"> <img src="images/11.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
						</div>
						<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/12.jpg" class="swipebox"  title="Image Title"> <img src="images/12.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
						</div>
						<div class="portfolio icon mix_all  wow bounceIn" data-wow-delay="0.4s" data-cat="icon" style="display: inline-block; opacity: 1;">
						<div class="portfolio-wrapper grid_box">		
							 <a href="images/13.jpg" class="swipebox"  title="Image Title"> <img src="images/13.jpg" class="img-responsive" alt=""><span class="zoom-icon"></span> </a>
		                </div>
						</div> -->
				<div class="clearfix"></div>					
				</div>
		  <div class="clearfix"></div>
			</div>

	

		</div>
	</div>
	<!-- sermons -->
				
	<!-- footer -->
	<?php include(TEMPLATES . "/footer.php") ?>		
	<!-- footer -->
	<script src="js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
</body>
</html>