<?php
/**
 * Client content.
 *
 * This template can be overridden by copying it to your theme/testimonial-free/templates/testimonial/content.php
 *
 * @package    Testimonial_Free
 * @subpackage Testimonial_Free/Frontend
 */

$content     = apply_filters( 'the_content', get_the_content() );
$review_text = apply_filters( 'sp_testimonial_review_content', $content, $post_id );
?>
<div class="sp-testimonial-client-testimonial">
	<?php do_action( 'sptpro_before_testimonial_content' ); ?>
	<div class="sp-testimonial-content">	<?php echo wp_kses_post( $review_text ); ?>
	</div>
	<?php do_action( 'sptpro_after_testimonial_content' ); ?>
</div>
<?php
