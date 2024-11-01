<?php

/**
 * Plugin Name: SiteSpeakAI
 * Plugin URI: https://sitespeak.ai
 * Description: Add a custom trained ChatGPT chatbot to your Wordpress site.
 * Version: 1.0.1
 * Author: SiteSpeakAI
 * Author URI: https://sitespeak.ai
 * License: GPL2
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

add_action('admin_menu', 'sitespeakai_add_options_page');

// Add the options page to the admin menu
function sitespeakai_add_options_page()
{
  add_options_page('SiteSpeakAI Plugin Settings', 'SiteSpeakAI', 'administrator', 'sitespeakai_id', 'sitespeakai_options_page');
  add_action('admin_init', 'sitespeakai_register_options');
}

// Register the options settings
function sitespeakai_register_options()
{
  register_setting('sitespeakai_options', 'sitespeakai_id');
}

// Define the content of the options page
function sitespeakai_options_page()
{
?>
  <div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
      <?php settings_fields('sitespeakai_options'); ?>
      <?php do_settings_sections('sitespeakai_options'); ?>
      <p>Enter your SiteSpeakAI chatbot ID below. You can get this ID from the <a href="https://sitespeak.ai/dashboard" target="_blank">Installation</a> page for your chatbot.</p>
      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th>
              <label for="sitespeakai_id">
                Chatbot ID (required)
              </label>
            </th>
            <td>
              <input name="sitespeakai_id" id="sitespeakai_id" type="text" value="<?php echo esc_html(get_option('sitespeakai_id')); ?>" class="regular-text code">
            </td>
          </tr>

        </tbody>
      </table>

      <?php submit_button(); ?>
    </form>
  </div>
<?php
}

function sitespeakai_embed_chatbot()
{
  $sitespeakai_id = get_option('sitespeakai_id');

  echo "<script type=\"text/javascript\">(function(){d=document;s=d.createElement(\"script\");s.src=\"https://sitespeak.ai/chatbots/", esc_attr($sitespeakai_id), ".js\";s.async=1;d.getElementsByTagName(\"head\")[0].appendChild(s);})();</script>";
}
add_action('wp_footer', 'sitespeakai_embed_chatbot');
?>