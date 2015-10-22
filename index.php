<?php
header('Content-Type: text/html; charset=UTF-8'); 
/**
 * Plugin Name: Amortiza
 * Plugin URI: http://EdoySoft.Net
 * Description: Calcule cu&aacute;nto pagar&aacute; mensualmente su hipoteca o pr &eacute;stamo con este plugin
 * Version: 1.0.0
 * Author: Edgar Cotes
 * Author URI: http://edoysoft.net
 * Tags: calculadora de amortización, amortiz
 * License: GPL2
 */
define('AMORTIZA_PLUGIN_URL', plugin_dir_url(__FILE__));

function load_amortiza() {
    wp_enqueue_style('amortizaestilo', AMORTIZA_PLUGIN_URL . 'amortizaestilo.css');
    wp_enqueue_script('amortizaquery', AMORTIZA_PLUGIN_URL . 'amortizascript.js', array('jquery'), "1.0.0", TRUE);
}

add_action('wp_enqueue_scripts', 'load_amortiza');

class amortiza_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'amortiza_widget', // Base ID
                'amortiza_Calcula', // Name
                array('description' => __('Es una simple calculadora para amortización', 'custom-text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        $html_content = '
                  <div align="center">
				  <div class="AMortCal">
                <label>Importe del pr&eacute;stamo($)</label>
                <input type="text" name="prestamo" id="prestamo" placeholder="Digite la cantidad" />
				 <p> </p>
                 <label>Plazo de la hipoteca(Anual)</label>
                <input type="text" name="anos" id="anos" placeholder="Cantidad de a&ntilde;os" />
				 <p> </p>
                <label>Tasa De Inter&eacute;s (%) Anual</label>
                <input type="text" name="interes" id="interes" placeholder="Digite tasa de inter&eacute;s" />
				 <p> </p>
                <input type="button" name="calcularprestamos" id="calcularprestamos" class="boton" value="Calcular" />
                <input type="button" name="resetear" id="resetear" value="Resetear" class="boton"/>
                <br class="clear"/>
				 <p> </p>
                <div class="resultado" id="resultado">Cuotas a pagar</div>
                </div>
				</div>';
        echo __($html_content, 'custom-text_domain');
        echo $args['after_widget'];
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Calcula tu préstamo', 'custom-text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            <br/>
         
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

// class Foo_Widget

/** registring widget */
function amortiza_Widget_regis() {
    register_widget('amortiza_Widget');
}

add_action('widgets_init', 'amortiza_Widget_regis');

function amortiza_Shortcode_function() {
    $html_content = '
               <div align="center">
				  <div class="AMortCal">
                <label>Importe del pr&eacute;stamo($)</label>
                <input type="text" name="prestamo" id="prestamo" placeholder="Digite la cantidad" />
				 <p> </p>
                 <label>Plazo de la hipoteca(Mensual)</label>
                <input type="text" name="anos" id="anos" placeholder="Cantidad de meses" />
				 <p> </p>
                <label>Tasa De Inter&eacute;s(%)</label>
                <input type="text" name="interes" id="interes" placeholder="Digite tasa de inter&eacute;s" />
				 <p> </p>
                <input type="button" name="calcularprestamos" id="calcularprestamos" class="boton" value="Calcular" />
                <input type="button" name="resetear" id="resetear" value="Resetear" class="boton"/>
                <br class="clear"/>
				 <p> </p>
                <div class="resultado" id="resultado">Cuotas a pagar</div>
                </div>
				</div>';
				
    return $html_content;
}

add_shortcode('amortiza', 'amortiza_Shortcode_function');
?>
