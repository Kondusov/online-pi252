<?php
/**
 * Help Panel.
 *
 * @package coffee_espresso
 */
?>

<div id="help-panel" class="panel-left visible">
    <div id="#help-panel" class="steps">  
        <h4 class="c">
            <?php esc_html_e( 'Quick Setup for Home Page', 'coffee-espresso' ); ?>
            <a href="<?php echo esc_url( COFFEE_ESPRESSO_THEME_DOCUMENTATION ); ?>" class="button button-primary" style="margin-left: 5px; margin-right: 10px;" target="_blank"><?php esc_html_e( 'Free Theme Documentation', 'coffee-espresso' ); ?></a>
        </h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to the Dashboard. navigate to pages, add a new one, and label it "home" or whatever else you like.The page has now been created.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '2) Go back to the Dashboard and then select Settings.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '3) Then Go to readings in the setting.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '4) There are 2 options your latest post or static page.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '5) Select static page and select from the dropdown you wish to use as your home page, save changes.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '6) You can set the home page in this manner.', 'coffee-espresso' ); ?></p>
        <br>
        <h4><?php esc_html_e( 'Setup Banner Section', 'coffee-espresso' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Go to Appereance > then Go to Customizer.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to Banner Section.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '4) In Banner Section > Enable the Toggle button > and fill the following details.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '5) In this way you can set Banner Section.', 'coffee-espresso' ); ?></p>
        <br>
        <h4><?php esc_html_e( 'Setup Properties Section', 'coffee-espresso' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to Dashboard > Appearance > then Customizer.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > then go to Properties Section.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '3) In Properties Section > Enable the Toggle button to activate the section.', 'coffee-espresso' ); ?></p>
        <p><?php esc_html_e( '4) In this way, you can set up the Properties Section.', 'coffee-espresso' ); ?></p>
        <br>
    </div>
    <div class="custom-setting">
        <h4><?php esc_html_e( 'Quick Customizer Settings', 'coffee-espresso' ); ?></h4>
        <span><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a></span>
    </div>
    <hr>
   <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img1.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Site Logo', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img2.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Color Picker', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=coffee_espresso_primary_color' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img3.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Theme Options', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=coffee_espresso_theme_options' ) ); ?>"target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
    </div>
    <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img4.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Header Image ', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img5.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Footer Option ', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=coffee_espresso_footer_copyright_text' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <img src="<?php echo esc_url(get_template_directory_uri()) .'/theme-library/getting-started/images/img6.png'; ?>" />
            </div>
            <h5><?php esc_html_e( 'Front Page Option', 'coffee-espresso' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=coffee_espresso_front_page_options' ) ); ?>" target="_blank" class=""><?php esc_html_e( 'Customize', 'coffee-espresso' ); ?></a>
            
        </div>
    </div>
</div>