<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://musiccomposer.com
 * @since      1.0.0
 *
 * @package    Music
 * @subpackage Music/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Music
 * @subpackage Music/public
 * @author     Avinash <avinash.deedwaniya@gmail.com>
 */
class Music_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Music_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Music_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/music-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Music_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Music_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/music-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Shortcode callback function to show Music listing on public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function music_listing($atts, $content = null){
		
		$music_master = new Music();
		$plugin_version = $music_master->get_version(); 
		$plugin_name= $music_master->get_plugin_name();
		
		$music_admin = new Music_Admin($plugin_name,$plugin_version);		
		
		$music_atts = shortcode_atts( array(
			'year' => '',
			'genre'  => ''
		), $atts );
		
		$music_atts = apply_filters( 'music_shortcode_attr_before', $music_atts );
		
		$music_grid = $pagination = '';		
		
		// Set paging
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		// Prepare argument array
		$args = array('post_type'=>'music','paged' => $paged);
		
		// Get the value of Music per page from option page in CMS
		if(trim(get_option('music_per_page')) !=''){
			$args['posts_per_page']=get_option('music_per_page');
		}
		
		// Meta taxonomy query
		if(trim($music_atts['genre'])!=''){
			$args['tax_query']=array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'name',
					'terms'    => $music_atts['genre'],
				),
			);
		}
		
		// If Year argument pass then join the custom table and update where conddition
		if(trim($music_atts['year'])!=''){
			add_filter( 'posts_join', array($this,'music_join_table'), 20, 2 );
			$args['myear']=esc_html($music_atts['year']);
			add_filter( 'posts_where', array($this,'music_where_table'), 20, 2 );
		}
		 
		$music_result = new WP_Query($args); 
		
		// Remove filter again
		remove_filter( 'posts_join', array($this,'music_join_table'), 20, 2 );		
		remove_filter( 'posts_where', array($this,'music_where_table'), 20, 2 );		
		
		if ( $music_result->have_posts() ){ 
			$music_grid.='<ul>';
			while ($music_result->have_posts()){
				$music_result->the_post();
				$thumb_image = $price = $compser_name = $publisher_name = $music_year_recording = $music_additional_contrib = $music_url = '';
				// Show pricing
				if($music_admin->get_music_meta(get_the_ID(),'music_price')){
					$price = '<br/>Price: &#'.get_option('currency').';'.$music_admin->get_music_meta(get_the_ID(),'music_price').';'; 				
				}
				// Show composer
				if($music_admin->get_music_meta(get_the_ID(),'compser_name')){
					$compser_name = '<br/>Composer: '.$music_admin->get_music_meta(get_the_ID(),'compser_name');					
				}
				//Show publisher
				if($music_admin->get_music_meta(get_the_ID(),'publisher_name')){
					$publisher_name = '<br/>Publisher: '.$music_admin->get_music_meta(get_the_ID(),'publisher_name');					
				}
				//Show Recording Year
				if($music_admin->get_music_meta(get_the_ID(),'music_year_recording')){
					$music_year_recording = '<br/>Recording: '.$music_admin->get_music_meta(get_the_ID(),'music_year_recording');					
				}
				// Show additional composer
				if($music_admin->get_music_meta(get_the_ID(),'music_additoonal_contrib')){
					$music_additional_contrib = '<br/>Additional Contributors: '.$music_admin->get_music_meta(get_the_ID(),'music_additoonal_contrib');					
				}
				//Show URL
				if($music_admin->get_music_meta(get_the_ID(),'music_url')){
					$music_url = '<br/>URL: <a href="'.$music_admin->get_music_meta(get_the_ID(),'music_url').'">Click here</a>';					
				}
				if ( has_post_thumbnail() ) {
					$thumb_image = get_the_post_thumbnail( get_the_ID(), 'thumbnail' ).'<br/>';
				}
				$music_grid.= '<li>'.$thumb_image.'<a href="'.get_the_permalink(get_the_ID()).'">'.get_the_title().'</a>'.$price.$compser_name.$publisher_name.$music_year_recording.$music_additional_contrib.$music_url.'</li>';
				
			} 
			$music_grid.='</ul>';
			 
			$pagination.= get_previous_posts_link( '<<' );
			$pagination= get_next_posts_link( '>>', $music_result->max_num_pages );
			// clean up after our query
			wp_reset_postdata(); 
			
			// Update the pagination display before render
			$music_grid.= apply_filters( 'music_pagination_before_render', $pagination );
		}
		else{ 
		 $music_grid.='<p clas=="no_music_result">No music found<p>';
		}
		
		// Alter the music grid wrapper
		$music_grid = apply_filters( 'music_grid_before_render', $music_grid );
		
		return $music_grid;
	}
	
	// Join the Music query with custom table field
	public function music_join_table( $join, $wp_query ) {
		global $wpdb; 
		$join .= " INNER JOIN ".$wpdb->prefix."music_meta as music_meta on music_meta.music_id = $wpdb->posts.ID"; 
		return $join;
	}
	
	// Update WP where query before execute
	public function music_where_table( $where, $wp_query) {
		global $wpdb;  
		 if ( isset( $wp_query->query['myear'] ) && absint( $wp_query->query['myear'] ) ) {
			$where .= $wpdb->prepare( " AND music_meta.meta_key='music_year_recording' AND music_meta.meta_value=%d", absint( $wp_query->query['myear'] ) );  
		 }
		return $where;
	}

}
