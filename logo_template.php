<?php
/*
Template Name: Logo Page Template
*/

get_header();


$content_columns = ot_get_option( 'coll_page_sidebar' ) ? '9' : '12';

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		// thumbnail
		$outputT = '';
		if ( has_post_thumbnail() ) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			$outputT .= '<section class="background js-coll-page-section coll-page-section">';
			$outputT .= '<div class="js-coll-parallax coll-section-background">';
			$outputT .= '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII="
                            class="coll-bg-image js-coll-lazy"
                            width="' . $thumb[1] . '"
                            height="' . $thumb[2] . '"
                            data-coll-src="' . $thumb[0] . '"
                            alt="' . get_the_title( $post->ID ) . '" />';
			$outputT .= '<div class="color-overlay"></div>';
			$outputT .= '</div>';
			$outputT .= '</section>';
		}

		?>
		<div class="wrapper common coll-single <?php if ( has_post_thumbnail() ) {
		echo 'coll-parallax';
} ?>" id="skrollr-body">
		<?php echo $outputT; ?>
		<section class="title-container js-coll-page-section coll-page-section">
			<div class="row">
				<div class="large-12 columns">
					<div class="title-wrapper">
						<h2 class="logo-text"><?php echo get_the_title( get_the_ID() ); ?></h2>

						<h3 class="subtitle-text">
							<?php echo coll_get_excerpt_by_id( get_the_ID(), ot_get_option( 'coll_excerpt_length' ), '<a><em><strong>', '' ); ?>
						</h3>
					</div>
				</div>
			</div>
		</section>
		<section class="content-container js-coll-page-section coll-page-section">
			<div class="row">
	<section id-"client_logos">
		<div class="clogo_container">
			<?php
			    $staffpost = array( 'post_type' => 'clogo','orderby'=> 'title', 'order' => 'ASC');
			    $loop = new WP_Query( $staffpost );
			?>
			 <?php while ( $loop->have_posts() ) : $loop->the_post();?>
			    <a class="clogo_block" href="<?php echo get_post_meta( $post->ID, '_cmb2_client_url', true ); ?>">
			      <img src="<?php echo get_post_meta( $post->ID, '_cmb2_logo_image', true ); ?>"/>
			      <!-- <span class="staff_name"><?php the_title(); ?></span> -->
			    </a>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	</section>
			</div>

		</section>





	<?php
	endwhile;
endif; ?>
<?php get_footer(); ?>