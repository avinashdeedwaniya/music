<div class="music_box"> 
    <p class="meta-options music_field">
        <label for="compser_name"><?php _e('Composer Name','music');?></label>
        <input id="compser_name" type="text" name="compser_name" value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'compser_name') ); ?>">
    </p>
	<p class="meta-options music_field">
        <label for="publisher_name"><?php _e('Publisher','music');?></label>
        <input id="publisher_name" type="text" name="publisher_name" value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'publisher_name') ); ?>">
    </p>
    <p class="meta-options music_field">
        <label for="music_year_recording"><?php _e('Year of recording','music');?></label>
        <input id="music_year_recording" type="number" name="music_year_recording"    value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'music_year_recording') ); ?>">
    </p>
	<p class="meta-options music_field">
        <label for="music_additoonal_contrib"><?php _e('Additional Contributors','music');?></label>
        <input id="music_additoonal_contrib" type="text" name="music_additoonal_contrib" value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'music_additoonal_contrib') ); ?>">
    </p>
	<p class="meta-options music_field">
        <label for="music_url"><?php _e('URL','music');?></label>
        <input id="music_url" type="url" name="music_url" value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'music_url') ); ?>">
    </p>
    <p class="meta-options music_field">
        <label for="music_price"><?php _e('Price','music');?></label>
        <input id="music_price" type="number" name="music_price" value="<?php echo esc_html( $this->get_music_meta( get_the_ID(), 'music_price') ); ?>">
    </p>
</div>