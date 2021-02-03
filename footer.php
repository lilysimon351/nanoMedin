
        </div>
	</div>
				</div>
				
				<!-- END CONTENT -->
				
				<footer class="footer">
					<div class="footer-in wrap-center">
						<div class="footer-one fx-row">
							<div class="footer-col footer-col-desc">
								<div class="footer-col-title title">О сайте</div>
								<div class="footer-col-content">
							
								© <?php echo date('Y'); ?> «<?php echo get_bloginfo('name'); ?>» <br><br>
								
								</div>
							</div>
							<?php dynamic_sidebar( 'footer-widget' ); ?>
						</div>
						<div class="footer-two fx-row fx-middle">
							<div class="footer-copyright fx-1">© <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>" style="color: DeepSkyBlue;"><?php echo get_bloginfo('name'); ?></a></div>
							<div>
		                    </div>
						</div>
					</div>
				</footer>
				
				<!-- END FOOTER -->
				
			</div></div>
			
			<!-- END WRAP -->

			<div class="search-wrap hidden">
				<div class="search-header fx-row fx-middle">
					<div class="search-title title">Поиск</div>
					<div class="search-close"><span class="far fa-times"></span></div>
				</div>
				<?php get_template_part('search-form-templates/popup'); ?>
			</div>
			
			<!-- END SEARCH-WRAP -->
		</div>
		<?php wp_footer(); ?>
	</body>
</html>