<?php
/*
Template Name: home
*/
?>
<?php get_header(); ?>

<main>
	<div class="main_wrapper">

		<section class="services">
			<div class="container">
				<div class="services_title main_title">Наши услуги</div>
				<div class="services_box">
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/granit.svg" alt="">
						</div>
						<p class="services_text">
							Гранитные памятники
						</p>
					</div>
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/mramor.svg" alt="">
						</div>
						<p class="services_text">
							Мраморные памятники
						</p>
					</div>
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/kombi.svg" alt="">
						</div>
						<p class="services_text">
							Комбинированные памятники
						</p>
					</div>
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/memorial.svg" alt="">
						</div>
						<p class="services_text">
							Мемориальные комплексы
						</p>
					</div>
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/blago.svg" alt="">
						</div>
						<p class="services_text">
							Благоустройство захоронения
						</p>
					</div>
					<div class="services_item">
						<div class="services_img">
							<img class="" src="<?php bloginfo('template_url') ?>/assets/img/gravi.svg" alt="">
						</div>
						<p class="services_text">
							Художественная гравировка
						</p>
					</div>
				</div>
				<a href="#" class="services_main_btn main_btn">Узнать больше</a>
			</div>
		</section>

		<section class="catalog">
			<div class="catalog_wrapper">
				<div class="container">
					<div class="catalog_title main_title">
						Каталог
					</div>
					<div class="catalog_tubs_box">
						<button class="catalog_tubs_btn catalog_tubs_btn_prev">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15.2 4.80005L8.70706 11.2929C8.31653 11.6835 8.31653 12.3166 8.70706 12.7072L15.2 19.2"
									stroke="#C37437" stroke-width="2" />
							</svg>
						</button>

						<?php
						$categories = get_categories(array(
							'taxonomy' => 'product_cat',
							'orderby' => 'name',
							'order' => 'ASC',
							'hide_empty' => false // true — скрыть пустые, false — показать все
						));
						?>

						<ul class="catalog_tubs_row">
							<?php foreach ($categories as $category): ?>
								<li class="catalog_tub_item"><a
										href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></li>
							<?php endforeach; ?>
						</ul>

						<button class="catalog_tubs_btn catalog_tubs_btn_next">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9 5L15.4929 11.4929C15.8834 11.8834 15.8834 12.5166 15.4929 12.9071L9 19.4" stroke="#C37437"
									stroke-width="2" />
								<path d="M8.80127 4.80005L15.2942 11.2929C15.6847 11.6835 15.6847 12.3166 15.2942 12.7072L8.80127 19.2"
									stroke="#C37437" stroke-width="2" />
							</svg>
						</button>
					</div>
					<div class="catalog_box">


						<?php
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => -1,
						);

						$loop = new WP_Query($args);

						while ($loop->have_posts()):
							$loop->the_post();
							global $product;
							?>

							<div class="catalog_item">
								<a href="<?php the_permalink(); ?>" class="catalog_item_link">
									<span class="catalog_item_img">
										<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
									</span>
									<span class="catalog_item_name">
										<?php the_title(); ?>
									</span>
								</a>
								<a href="" class="catalog_item_btn">Заказать</a>
							</div>

						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>





					<div class="product-tabs-container">
						<!-- Список табов-категорий -->
						<ul class="product-category-tabs">
							<li><a href="#" class="cat-tab active" data-slug="">Все</a></li>
							<?php
							$terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => true]);
							foreach ($terms as $term): ?>
								<li><a href="#" class="cat-tab" data-slug="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul>

						<!-- Блок для вывода товаров -->
						<div id="ajax-products-container" class="products-grid">
							<!-- Здесь появятся товары после клика -->
							<p>Выберите категорию...</p>
						</div>
					</div>



				</div>
				<a href="#" class="main_btn catalog_main_btn">Смотреть весь каталог</a>
			</div>
	</div>
	</section>

	<?php if (have_rows('slides', 'option')): ?>
		<section class="carusel">
			<div class="container carusel_container_top">
				<div class="main_title carusel_title"><?php the_field('title_slider', 'option'); ?></div>
				<div class="carusel__arrow carusel__prev">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M23 6L11.7071 17.2929C11.3166 17.6834 11.3166 18.3166 11.7071 18.7071L23 30" stroke="#C37437"
							stroke-width="3" />
					</svg>
				</div>
				<div class="carusel__arrow carusel__next">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13 6L24.2929 17.2929C24.6834 17.6834 24.6834 18.3166 24.2929 18.7071L13 30" stroke="#C37437"
							stroke-width="3" />
					</svg>
				</div>
			</div>
			<div class="carusel__slider_main_wrapper">
				<div class="container">
					<div class="swiper carusel__slider-wrapper">
						<div class="swiper-wrapper carusel__slider">
							<?php while (have_rows('slides', 'option')):
								the_row();
								?>
								<div class="swiper-slide carusel__slide"><img data-fancybox="gallery" src="<?php the_sub_field('foto'); ?>"
										alt="<?php the_sub_field('description'); ?>"></div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-pagination carusel__pagination"></div>
		</section>
	<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>