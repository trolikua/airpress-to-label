<?php
/*
Plugin Name: Airpress To Label
Description: Special plugin made for the client. The plugin search data from Airtable and make labels for print.
Version: 1.0
*/

add_action( 'wp_enqueue_scripts', 'choco_scripts' );
function choco_scripts() {
    wp_register_style( 'custom-style', plugins_url( '/style.css', __FILE__ ), array(), 'all' );
    wp_enqueue_style( 'custom-style' );
    wp_enqueue_script( 'jquery-ui', plugins_url('/jquery-ui/jquery-ui.min.js', __FILE__), array( 'jquery-ui-autocomplete', 'jquery' ) );
    wp_enqueue_style( 'jquery-ui-style', plugins_url( '/jquery-ui/jquery-ui.min.css', __FILE__ ), array(), 'all' );
}

function wpse255804_add_page_template ($templates) {
    $templates['label-search-form.php'] = 'Label search form';
    $templates['single-choco.php'] = 'Single choco label';
    return $templates;
}
add_filter ('theme_page_templates', 'wpse255804_add_page_template');

function wpse255804_redirect_page_template ($template) {
    $post = get_post();
    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
    if ('label-search-form.php' == basename ($page_template )) {
        $template = WP_PLUGIN_DIR . '/airpress-to-label/label-search-form.php';
    }
    elseif ('single-choco.php' == basename ($page_template )) {
        $template = WP_PLUGIN_DIR . '/airpress-to-label/single-choco.php';
    }
    return $template;
}
add_filter ('page_template', 'wpse255804_redirect_page_template');

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script( 'form-js', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}

add_action( 'wp_ajax_send_form', 'form_action_callback' );
add_action('wp_ajax_nopriv_send_form', 'form_action_callback');
function form_action_callback() {
    $whatever =  $_POST;

    print_r($whatever) ;
    wp_die();
}

add_action('wp_footer', 'my_action_javascript', 99);
function my_action_javascript() {
    ?>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            var availableTitles = <?php echo json_encode(airpressTitles (), true); ?>;
            jQuery('input#label-search').autocomplete({
                source: availableTitles,
                minLength: 2
            });
        });
    </script>
    <?php
}

function airpressTitles () {
    $query = new AirpressQuery();
    $query->setConfig("config");
    $query->table("Products");
    $list = new AirpressCollection($query);

    $titles = [];
    foreach($list as $e){
        $titles[] = ($e['PRODUCTNAME']);
    }
    return $titles;
}