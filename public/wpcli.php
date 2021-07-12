<?php
use WP_CLI\Utils;
 
if(defined('WP_CLI') && WP_CLI){
	
	class Music_CLI{
		
		public function delete_music($args, $assoc_args){
			
			 
			
			if(isset($assoc_args['all']) && trim($assoc_args['all'])!=''){
				
				// prepare argument to fetch all music posts
				$args = array('post_type' => 'music' ,'posts_per_page' => -1);

				$music_arr = new WP_Query( $args );
				// The Loop
				if ( $music_arr->have_posts() ) {
					
					// Show total posts on command prompt
					WP_CLI::warning('Total Music found:'.$music_arr->found_posts);
					
					// Show progressbar on command prompt
					$progress = \WP_CLI\Utils\make_progress_bar('Music deletion',$music_arr->found_posts);
					
					while ( $music_arr->have_posts() ) {
						$music_arr->the_post();
						
						// Delete post by id
						wp_delete_post( get_the_ID(), true); 
					}
					wp_reset_postdata();
					$progress->finish();
					
					// Show success message on command prompt
					WP_CLI::success('Deletion successfully');
				} 
				else{
					// Show not found message on command prompt
					WP_CLI::error('No music found!!');
				}
			}
	
			if(isset($assoc_args['title']) && trim($assoc_args['title'])!=''){ 
			
				// prepare argument to fetch all music posts
				$args = array('s' => $assoc_args['title'],'post_type' => 'music' ,'posts_per_page' => -1);

				$music_arr = new WP_Query( $args );
				// The Loop
				if ( $music_arr->have_posts() ) {
					
					// Show total posts on command prompt
					WP_CLI::warning('Total Music found:'.$music_arr->found_posts);
					
					// Show progressbar on command prompt
					$progress = \WP_CLI\Utils\make_progress_bar('Music deletion',$music_arr->found_posts);
					
					while ( $music_arr->have_posts() ) {
						$music_arr->the_post();
						
						// Delete post by id
						wp_delete_post( get_the_ID(), true); 
					}
					wp_reset_postdata();
					$progress->finish();
					
					// Show success message on command prompt
					WP_CLI::success('Deletion successfully');
				} 
				else{
					// Show not found message on command prompt
					WP_CLI::error('No title found!!');
				}				
			}
		}			
	}
	
	// Add command on WPCLI
	WP_CLI::add_command('music', 'Music_CLI');
	// wp music delete_music --all=yes  --title=Music1
}