<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://musiccomposer.com
 * @since      1.0.0
 *
 * @package    Music
 * @subpackage Music/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Music
 * @subpackage Music/admin
 * @author     Avinash <avinash.deedwaniya@gmail.com>
 */
class Music_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/music-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/music-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register the Music custom post type.
	 *
	 * @since    1.0.0
	 */
	public function music_register_cpt(){
		$labels = [
			"name" => __( "Music",'music'),
			"singular_name" => __( "Music",'music'),
			"menu_name" => __( "Music",'music'),
			"all_items" => __( "All Music",'music'),
			"add_new" => __( "Add New Music",'music'),
			"add_new_item" => __( "Add New Music",'music'),
			"edit_item" => __( "Edit Music",'music'),
			"new_item" => __( "New Music",'music'),
			"view_item" => __( "View Music",'music'),
			"view_items" => __( "View Music",'music'),
			"search_items" => __( "Search Music",'music'),
			"not_found" => __( "No Music found",'music'),
			"not_found_in_trash" => __( "No Music found in trash",'music'),
			"parent" => __( "Parent Music",'music'),
			"name_admin_bar" => __( "Music",'music'),
			"item_published" => __( "Music published",'music'),
			"item_updated" => __( "Music updated",'music'),
			"parent_item_colon" => __( "Parent Music",'music'),
		];

		$args = [
			"label" => __( "Music"),
			"labels" => $labels,
			"public"    => true,
			"menu_icon" => "dashicons-book",
			"description" => "This is music custom post type", 
			"supports" => array( 'title', 'editor', 'thumbnail' ),			
			"rewrite" => array('slug' => 'music')
		]; 
		register_post_type( "music", $args );
		unset( $args );
		unset( $labels );
		flush_rewrite_rules();
	}
	
	/**
	 * Register Genres and Music taxonomy for Music post type.
	 *
	 * @since    1.0.0
	 */	
	public function music_register_taxonomy(){
		$labels = array(
			'name'              => __( 'Genres','music' ),
			'singular_name'     => __( 'Genre','music'),
			'search_items'      => __( 'Search Genres','music'),
			'all_items'         => __( 'All Genres','music'),
			'parent_item'       => __( 'Parent Genre','music'),
			'parent_item_colon' => __( 'Parent Genre:','music'),
			'edit_item'         => __( 'Edit Genre','music'),
			'update_item'       => __( 'Update Genre','music'),
			'add_new_item'      => __( 'Add New Genre','music'),
			'new_item_name'     => __( 'New Genre Name','music'),
			'menu_name'         => __( 'Genre','music'),
		);
	 
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		);
	 
		register_taxonomy( 'genre', array( 'music' ), $args );
	 
		unset( $args );
		unset( $labels );
	 
		// Add new taxonomy, NOT hierarchical
		$labels = array(
			'name'                       => __( 'Music','music'),
			'singular_name'              => __( 'Music', 'taxonomy singular name'),
			'search_items'               => __( 'Search Music','music'),
			'all_items'                  => __( 'All Music','music'),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Music','music'),
			'update_item'                => __( 'Update Music','music'),
			'add_new_item'               => __( 'Add New Music','music'),
			'new_item_name'              => __( 'New Music Name','music'),
			'separate_items_with_commas' => __( 'Separate Musics with commas','music'),
			'add_or_remove_items'        => __( 'Add or remove Music','music'), 
			'not_found'                  => __( 'No music found.','music'),
			'menu_name'                  => __( 'Music','music'),
		);
	 
		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true, 
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'music_category' ),
		);
	 
		register_taxonomy( 'music_category',  array( 'music' ), $args );
	}
	
	/**
	 * Register meta box for Music post type.
	 *
	 * @since    1.0.0
	 */
	public function music_register_meta_boxes() {
		add_meta_box( 'music', __( 'Music Information', 'music' ), array($this,'music_meta_display_callback'), 'music' );
	}
	
	/**
	 * Callback function for metabox
	 *
	 * @since    1.0.0
	 */
	public function music_meta_display_callback( $post ) {
		include plugin_dir_path( __FILE__ ) . './music_meta_fields.php';
	}
	
	/**
	 * Save the meta values in a custom table
	 *
	 * @since    1.0.0
	 */
	public function music_save_meta_box( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( $parent_id = wp_is_post_revision( $post_id ) ) {
			$post_id = $parent_id;
		}
		$fields = [
			'compser_name',
			'publisher_name',
			'music_year_recording',
			'music_additoonal_contrib',
			'music_url',
			'music_price',
		];
		foreach ( $fields as $field ) {
			if ( array_key_exists( $field, $_POST ) ) {
				$this->update_music_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
			}
		 }
	}
	
	/**
	 * Update the value in Music custom tale. Insert if not exist.
	 *
	 * @since    1.0.0
	 */	
	public function update_music_meta($mid,$column,$data){
		global $table_prefix, $wpdb;
		$sql = "SELECT count(meta_id)as cid FROM ".$table_prefix."music_meta WHERE `music_id`=".$mid." AND `meta_key`='".$column."'";
		$result = $wpdb->get_results($sql); 
		 
		if($result[0]->cid == 0){
			$wpdb->insert( 
				$table_prefix."music_meta", 
				array( 
					'music_id'    => $mid, 
					'meta_key'  => esc_html($column),
					'meta_value' => esc_html($data),
				),
				array( '%d', '%s', '%s')
			); 
		}
		else{
			$wpdb->update($table_prefix."music_meta", array( 
			'meta_value' => esc_html($data),
				),
			 array('music_id'=>$mid,'meta_key'=>$column));
		}
	}
	
	/**
	 * Get the value of Music meta fields from a custom table.
	 *
	 * @since    1.0.0
	 */
	public function get_music_meta($mid,$column){
		global $table_prefix, $wpdb;
		$sql = "SELECT meta_value FROM ".$table_prefix."music_meta WHERE `music_id`=".$mid." AND `meta_key`='".esc_html($column)."'";
		$result = $wpdb->get_results($sql);
		if(!empty($result)){ 
			if($result[0]->meta_value != ''){
				return esc_html($result[0]->meta_value);
			}
		}
		return '';
	}
	
	/**
	 * Create admin menu in CMS
	 *
	 * @since    1.0.0
	 */
	public function music_create_menu() {

		//create new top-level menu
		add_submenu_page('edit.php?post_type=music',__( 'Music Settings','music'), __( 'Music Settings','music'), 'manage_options', __FILE__, array($this,'music_settings_page') );
	}

	/**
	 * Register the option group settings.
	 *
	 * @since    1.0.0
	 */
	public function register_music_settings() {
		//register our settings
		register_setting( 'music-plugin-settings-group', 'currency' );
		register_setting( 'music-plugin-settings-group', 'music_per_page' ); 
	}
	
	/**
	 * Custom option page for Music settings.
	 *
	 * @since    1.0.0
	 */
	public function music_settings_page() {
		$currency_arr = array(36,163,8364,8377);
		?>
		<div class="wrap">
		<h1><?php _e('Music Settings','music');?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'music-plugin-settings-group' ); ?>
			<?php do_settings_sections( 'music-plugin-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php _e('Currency','music');?></th>
				<td><select name="currency" >
				<?php
				foreach($currency_arr as $val){
					$selected='';
					if($val == esc_attr( get_option('currency') )){
						$selected='selected="selected"';
					}					
					echo'<option value="'.$val.'" '.$selected.'>&#'.$val.';</option>';
				}
				?> 
				</select>
				 </td>
				</tr> 
				<tr valign="top">
				<th scope="row"><?php _e('Music per page','music');?></th>
				<td><input type="text" name="music_per_page" value="<?php echo esc_attr( get_option('music_per_page') ); ?>" /></td>
				</tr> 
			</table> 
			<?php submit_button(); ?> 
		</form>
		</div>
	<?php
	}
}
