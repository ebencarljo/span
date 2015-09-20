<?php if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'left-sidebar' ) === 'left-sidebar' ):?>
<?php
// Get Custom sidebar or default, if not defined
$sidebar				=	span_hopt( 'left_sidebar', span_tag_hierarchy(), 'left-sidebar' );
	if( is_active_sidebar( $sidebar ) ):
	?>
	<aside id="sidebar" class="col-md-3 left-sidebar"> 
		<?php dynamic_sidebar( $sidebar );?>
	</aside>
	<?php else: ?>
	<aside id="sidebar" class="col-md-3 left-sidebar"> 
   	<?php if( intval( span_hopt( 'debug_mode', span_tag_hierarchy(), '1' ) ) == true ):?>
			<div class="call-action call-action-boxed call-action-style1 clearfix" style="color:#333;margin:5px 0px 60px 0px;">
           <!-- Call Action Button -->
           <div class="button-side" style="margin-top:8px;float:none;">
            <a href="<?php echo admin_url( 'widgets.php' );?>" class="btn btn-small btn-effect"><?php _e( 'Change Sidebar', 'span' );?></a>
           </div>
           <h2 class="primary"><strong>Span</strong> <?php _e( 'No widgets assigned to this sidebar', 'span' );?></h2>
           <p><?php echo sprintf( __( 'Log to your dashboard to assign a widget to this area : <strong>%s</strong>', 'span' ), $sidebar );?></p>
         </div>
      <?php endif;?>
	</aside>   
   <?php endif;?>

<?php endif;?>