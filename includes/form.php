<?php get_header(); ?>
<div class="cols fx-row sect">
	<main class="col-left fx-1">
		<div class="speedbar nowrap"><span class="far fa-home"></span>
			<span id="dle-speedbar" itemscope="" itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><meta itemprop="position" content="1"><a href="<?php home_url(); ?>" itemprop="item"><span itemprop="name"><?php echo get_bloginfo('name'); ?></span></a></span> » Обратная связь</span>
		</div>
		<div id="dle-content">
			<?php 
			if(isset($_POST['send_btn'])){
				if(isset($_POST['message'])){
					$msg = sanitize_textarea_field( $_POST['message'] );
					if( $msg != ''){
						wp_mail( get_option( 'admin_email ' ), 'Сообщение с сайта nanomedin.ru', $msg );
					?>
					<div class="search-page">
						<div class="berrors"><b>Сообщение успешно отправлено</b> <br>
						Ваше сообщение успешно отправлено. <a href=" <?php home_url(); ?> ">Вернуться на главную</a> .</div>
					</div>
					
				<?php
					}
				}
			}
			else { ?>
				<div class="search-page">
					<div class="berrors"><b>Внимание! Обнаружена ошибка</b> <br>
					Вы не указали текст сообщения.<br>
					 <a href="/kontakty">Вернуться назад</a>. </div>
				</div>
				
		<?php
			}
		?>
	</div>
</main>
		<?php dynamic_sidebar('sidebar'); ?>
</div>
<?php get_footer(); ?>