<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RM_Consulting
 */

?>

	<footer class="page-foot" role="contentinfo">
		<a href="#top" class="js-to-top"><i class="icon-up-open-big"></i><span class="sr-only"><?php echo __('Ir para o topo', 'rm' ) ;?></span></a>
		<img src="<?php bloginfo('template_directory');?>/assets/build/img/carapau_logo.svg" alt="O Carapau Criativo">
		<p class="m-b-0">O Carapau Criativo &copy; <?php echo date('Y'); ?>&nbsp;|&nbsp;<a href="#">Privacy Policy</a></p>
		<p class="sr-only"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'rm' ), 'rm', '<a href="http://www.eduardodomingos.com/" rel="designer">Eduardo Domingos</a>' ); ?></p>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
