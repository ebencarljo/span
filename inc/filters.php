<?php
// Changing excerpt lenght
function span_excerpt_length(){
	return 30;
}
add_filter( 'excerpt_length' , 'span_excerpt_length' );
