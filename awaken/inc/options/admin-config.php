<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: https://docs.reduxframework.com
     * */

    if ( ! class_exists( 'Awaken_Redux_Options_Framework' ) ) {

        class Awaken_Redux_Options_Framework {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'awaken' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'awaken' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'awaken' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'awaken' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'awaken' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'awaken' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'awaken' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'title'  => __( 'General Settings', 'awaken' ),
                    'desc'   => __( 'Use this tab to set the general settings of your site', 'awaken' ),
                    'icon'   => 'el-icon-cogs',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                        array(
                            'id'       => 'logo-uploader',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Logo', 'awaken' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Make sure that you have selected the option below to display the logo.', 'awaken' ),
                            'subtitle' => __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'awaken' ),
                            'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
                            //'hint'      => array(
                            //    'title'     => 'Hint Title',
                            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                            //)
                        ),                        
                        array(
                            'id'    => 'pro-general',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => __('<a href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Upgrade to Pro</a>', 'awaken'),
                            'desc'  => __('Pro Version Comes with Layout Options, Unlimited Colors, Post Options, Unlimited Sidebars etc.',  'awaken')
                        ),
           
                        array(
                            'id'       => 'site-title-option',
                            'type'     => 'radio',
                            'title'    => __( 'Display Site Title / Logo', 'awaken' ),
                            'subtitle' => __( 'Choose your preffered option.', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                'text-only' => 'Display site title and description only.',
                                'logo-only' => 'Display logo only.',
                                'text-logo' => 'Display both logo and text.',
                                'title-none' => 'Display none.'
                            ),
                            'default'  => 'text-only'
                        ),
                        array(
                            'id'       => 'excerpt-more',
                            'type'     => 'textarea',
                            'title'    => __( 'Read more text', 'awaken' ),
                            'subtitle' => __( 'Give a read more text for posts.', 'awaken' ),
                            'desc'     => __( 'You can use html if you want.', 'awaken' ),
                            'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                            'default'  => '[...]'
                        ),
                        array(
                            'id'       => 'favicon-display-checkbox',
                            'type'     => 'switch',
                            'title'    => __( 'Show Favicon', 'awaken' ),
                            'subtitle' => __( 'Choose your preferred option.', 'awaken' ),
							'default'  => '0'
                        ),
                        array(
                            'id'       => 'section-media-start',
                            'type'     => 'section',
                            'title'    => __( 'Favicon', 'awaken' ),
                            //'subtitle' => __( 'With the "section" field you can create indent option sections.', 'awaken' ),
                            'indent'   => true, // Indent all options below until the next 'section' option is set.
                            'required' => array( 'favicon-display-checkbox', "=", 1 ),
                        ),
                        array(
                            'id'       => 'favicon-uploader',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Upload a favicon', 'awaken' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Upload a site favicon', 'awaken' ),
                            'subtitle' => __( 'Upload or choose a favicon for your website.', 'awaken' ),
                            'default'  => array( 'url' => 'http://s.wordpress.org/style/images/codeispoetry.png' ),
                            //'hint'      => array(
                            //    'title'     => 'Hint Title',
                            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                            //)
                        ),
                        array(
                            'id'       => 'section-media-end',
                            'type'     => 'section',
                            'indent'   => false, // Indent all options below until the next 'section' option is set.
                            'required' => array( 'favicon-display-checkbox', "=", 1 ),
                        ),
                        array(
                            'id'       => 'awaken-header-code',
                            'type'     => 'textarea',
                            'title'    => __( 'Header Code', 'awaken' ),
                            'subtitle' => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header of your theme.', 'awaken' ),
                            'validate' => 'js',
                            'desc'     => 'Validate that it\'s javascript!',
							'default'  => ''
                        ),
                        array(
                            'id'       => 'awaken-footer-text',
                            'type'     => 'editor',
                            'title'    => __( 'Footer Text', 'awaken' ),
                            'subtitle' => __( 'Enter your text here. If you want to align the text, center or right simply do that using the editor', 'awaken' ),
                            'default'  => '',
                        ),
                    ),
                );


                $this->sections[] = array(
                    'title'  => __( 'Home Settings', 'awaken' ),
                    'desc'   => __( 'Use this tab to set the homepage settings of your site', 'awaken' ),
                    'icon'   => 'el-icon-home',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                        array(
                            'id'       => 'home-slider-activate',
                            'type'     => 'checkbox',
                            'title'    => __( 'Activate Slider', 'awaken' ),
                            'subtitle' => __( 'Check the checkbox to activate the slider', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
                        array(
                            'id'       => 'slider-category',
                            'type'     => 'select',
                            'data'     => 'categories',
                            'title'    => __( 'Select the slider category', 'awaken' ),
                            'subtitle' => __( 'Post thumbnails of the posts from selected category will be displayed in the slider', 'awaken' ),
                            'desc'     => __( 'Do not select a category or close the current category if you want to display latest posts.', 'awaken' ),
                            'default'  => ''
                        ),
                        array(
                            'id'       => 'fposts-category',
                            'type'     => 'select',
                            'data'     => 'categories',
                            'title'    => __( 'Select the featured posts category', 'awaken' ),
                            'subtitle' => __( 'Post thumbnails of the posts from selected category will be displayed as featured posts', 'awaken' ),
                            'desc'     => __( 'Do not select a category or close the current category if you want to display latest posts.', 'awaken' ),
                            'default'  => ''
                        ),
                        array(
                            'id'    => 'pro-home',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => __('<a href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Upgrade to Pro</a>', 'awaken'),
                            'desc'  => __('Pro Version comes with unlimited slides, more slider options, custom slider etc',  'awaken')
                        ),
                    ),
                );


                $this->sections[] = array(
                    'title'  => __( 'Styling Options', 'awaken' ),
                    'desc'   => __( 'Use this tab to set the style settings of the site', 'awaken' ),
                    'icon'   => 'el-icon-website',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(
                        array(
                            'id'    => 'pro-styling',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => __('<a href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Upgrade to Pro</a>', 'awaken'),
                            'desc'  => __('Pro Version comes with unlimited fonts, unlimited colors, custom styling options, boxed and wide layouts. etc',  'awaken')
                        ),
                        array(
                            'id'       => 'awaken-background',
                            'type'     => 'background',
                            'output'   => array( 'body' ),
                            'title'    => __( 'Body Background', 'awaken' ),
                            'subtitle' => __( 'Body background with image, color, etc.', 'awaken' ),
                            //'default'   => '#FFFFFF',
                        ),
                        array(
                            'id'       => 'awaken-ace-editor-css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'Custom CSS Code', 'awaken' ),
                            'subtitle' => __( 'Add your CSS code here.', 'awaken' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'default'  => ""
                        ),
                    ),
                );

                $this->sections[] = array(
                    'title'  => __( 'Post / Page Options', 'awaken' ),
                    'desc'   => __( 'Use this tab to set the post settings of the site', 'awaken' ),
                    'icon'   => 'el-icon-pencil-alt',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(
                        array(
                            'id'       => 'awaken-post-comments',
                            'type'     => 'switch',
                            'title'    => __( 'Comment area on posts.', 'awaken' ),
                            'subtitle' => __( 'Switch on if you want to display comments and comment form in posts.', 'awaken' ),
                            //'options' => array('on', 'off'),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'awaken-page-comments',
                            'type'     => 'switch',
                            'title'    => __( 'Comment area on pages.', 'awaken' ),
                            'subtitle' => __( 'Switch on if you want to display comments and comment form in pages.', 'awaken' ),
                            //'options' => array('on', 'off'),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'featured-image-switch',
                            'type'     => 'switch',
                            'title'    => __( 'Display featured image in single post article.', 'awaken' ),
                            'subtitle' => __( 'Switch on if you want to display featured images in single posts.', 'awaken' ),
                            //'options' => array('on', 'off'),
                            'default'  => true,
                        ),      
                        array(
                            'id'    => 'pro-general',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => __('<a href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Upgrade to Pro</a>', 'awaken'),
                            'desc'  => __('Pro version comes with more post options.',  'awaken')
                        ),                                          
                    ),
                );


                $this->sections[] = array(
                    'title'  => __( 'Social Media', 'awaken' ),
                    'desc'   => __( 'Use this tab to set the social media settings of the site', 'awaken' ),
                    'icon'   => 'el-icon-link',
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(
                        array(
                            'id'       => 'social_media_switch',
                            'type'     => 'checkbox',
                            'title'    => __( 'Display social media icons.', 'awaken' ),
                            'subtitle' => __( 'Check the checkbox to activate social icons.', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
                        array(
                            'id'       => 'facebook-url',
                            'type'     => 'text',
                            'title'    => __( 'Facebook Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'twitter-url',
                            'type'     => 'text',
                            'title'    => __( 'Twitter Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'googleplus-url',
                            'type'     => 'text',
                            'title'    => __( 'Google Plus Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'linkedin-url',
                            'type'     => 'text',
                            'title'    => __( 'Linkedin Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'rss-url',
                            'type'     => 'text',
                            'title'    => __( 'RSS Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'instagram-url',
                            'type'     => 'text',
                            'title'    => __( 'Instagram Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'flickr-url',
                            'type'     => 'text',
                            'title'    => __( 'Flickr Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'       => 'youtube-url',
                            'type'     => 'text',
                            'title'    => __( 'Youtube Link', 'awaken' ),
                            'subtitle' => __( 'This must be a URL. Start with http://', 'awaken' ),
                            //'desc'     => __( 'This is the description field, again good for additional info.', 'awaken' ),
                            'validate' => 'url',
                            'default'  => '',
                        ),
                        array(
                            'id'    => 'pro-social',
                            'type'  => 'info',
                            'style' => 'success',
                            'title' => __('<a href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Upgrade to Pro</a>', 'awaken'),
                            'desc'  => __('Pro Version comes with more social media link options.',  'awaken')
                        ),
                    ),
                );



                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-eye-open',
                    'title'  => __( '<span class="sp-menu">Theme Support</span>', 'awaken' ),
                    'desc'   => __( '<p class="description">Follow these links to get more details about Awaken WordPress Theme.</p>', 'redux-framework-demo' ),
                    'fields' => array(

                        array(
                            'id'   => 'opt-info-field',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __( '<h4><a class="thgreen" href="http://www.themezhut.com/themes/awaken" target="_blank">Theme Details</a></h4> <h4><a class="thred" href="http://www.themezhut.com/awaken-wordpress-theme-documentation" target="_blank">Theme Setup Guide</a></h4> <h4><a class="thblue" href="http://www.themezhut.com/demo/awaken" target="_blank">Theme Demo</a></h4> <h4><a class="thlgreen" href="http://wordpress.org/themes/awaken" target="_blank">Rate Awaken Theme</a></h4> <h4><a class="thbrown" href="http://www.themezhut.com/themes/awaken-pro" target="_blank">Awaken Pro Details</a></h4> <h4><a class="thpurple" href="http://www.themezhut.com/demo/awaken-pro" target="_blank">Awaken Pro Demo</a></h4>', 'awaken' )
                        ),

                        array(
                            'id'    => 'th-opt-info-rate',
                            'type'  => 'info',
                            'style' => 'success',
                            'icon'  => 'el el-star',
                            'title' => __( '<h4>Support Us.</h4>', 'awaken' ),
                            'desc'  => __( 'The best way to thank us is, by rating our theme with 5 stars. <a href="http://wordpress.org/themes/awaken" target="_blank">Click here to rate our theme.</a>', 'awaken' )
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'awaken' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'awaken' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'awaken' ),
                    //'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'awaken' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'awaken' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'awaken' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'awaken' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'awaken' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'awaken' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'awaken_options',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Awaken Options', 'awaken' ),
                    'page_title'           => __( 'Awaken Options', 'awaken' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'theme_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/themezhut',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );                
				$this->args['share_icons'][] = array(
                    'url'   => 'https://plus.google.com/+Themezhutthemes',
                    'title' => 'Follow us on Google+',
                    'icon'  => 'el-icon-googleplus'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://twitter.com/ThemezHut',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    //$this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'awaken' ), $v );
                } else {
                    //$this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'awaken' );
                }

                // Add content after the form.
                //$this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'awaken' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Awaken_Redux_Options_Framework();
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;


