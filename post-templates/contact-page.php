<?php
	/*
		Template Name: Шаблон для страницы контактов
	*/
?>

<?php get_header(); ?>
<div class="cols fx-row sect">
	<main class="col-left fx-1">
		<div class="speedbar nowrap">
			<span class="far fa-home"></span>
				<span id="dle-speedbar">
					<a href="<?php home_url(); ?>">
						<span itemprop="name"><?php echo get_bloginfo('name'); ?></span>
					</a>
				</span> 
				» Обратная связь
			</span>
		</div>

		<div id="dle-content">
			<div class="form-wrap">
				<h1><font color="#00BFFF"><i class="far fa-share-square"></i></font>&nbsp;&nbsp;Обратная связь</h1>
				<br>
			</div>
			<?php 
				if(isset($_POST['send_btn'])):
					if(isset($_POST['message'])): 
						$msg = sanitize_textarea_field( $_POST['message'] ); ?>

						<div class="berrors">

								<?php 
								if( $msg != ''):
									if( strlen($msg) < 15 ): ?>
										<b>Внимание! Обнаружена ошибка</b> 
										<br><br>
										Сообщение слишком короткое.
										<br>
									<?php else: ?>
											<?php 
											$is_sent = wp_mail( get_option( 'admin_email ' ), 'Сообщение с сайта nanomedin.ru', $msg );
											if($is_sent): ?>
												<b>Сообщение успешно отправлено</b> 
												<br><br>
												Ваше сообщение успешно отправлено. 
												<br> 
											<?php else: ?>
												<b>Произошла ошибка</b> 
												<br><br>
												Пожалуйста, попробуйте еще раз.
												<br> 
											<?php endif; ?>
									<?php endif; ?>

								<?php else: ?>
										<b>Внимание! Обнаружена ошибка</b> 
										<br><br>
										Вы не указали текст сообщения.
										<br>
								<?php endif; ?>	
						</div>
					<?php endif; ?>	
				<?php endif; ?>	
				
				<form method="post" id="sendmail" name="sendmail" action="">
					<div class="form-wrap">

						<h5><font color="#00BFFF"><i class="fas fa-info-circle"></i></font>&nbsp;&nbsp;Внимание! <br>
						Персональные данные вводить не обязательно. <br>
						Никакая информация от пользователей сайта не собирается, не хранится, не обрабатывается.</h5>
						
						<div class="form-item clearfix">
							<input type="hidden" name="email" value="не указано">
						</div>	
				
						<div class="form-item clearfix">
						<label><input type="hidden" name="recip" value="1"></label>
						
						</div>
				
						<div class="form-item clearfix">
							<input type="hidden" name="subject" value="не указано">
						</div>
				
						<div class="form-textarea">
							<label>Ваше сообщение:</label>
							<textarea placeholder="О чем болит ваша душа? Что Вас тревожит? Напишите здесь. Если сообщение требует ответа, можно указать телефон или email" name="message" style="height: 160px" ></textarea>
						</div>
						<div class="form-submit">
							<button name="send_btn" type="submit">Отправить</button>
						</div>
					</div>
				</form>
	</div>
</main>
		<?php dynamic_sidebar('sidebar'); ?>
</div>
<?php get_footer(); ?>