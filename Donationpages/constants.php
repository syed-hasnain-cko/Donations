<?php
  global $wpdb;
  $cards = $wpdb->prefix . 'card_keys';
  $result = $wpdb->get_results("SELECT * FROM $cards LIMIT 1 ");
  if (!empty($result)) :
    foreach ($result as $row) :
      $threed_key = $row->threed_key ?? "";
      $capture_key = $row->capture_key ?? "";
      $secretcard_key = $row->secretcard_key ?? "";
      $publiccard_key = $row->publiccard_key ?? "";
      $success_url = $row->success_url ?? "";
      $failure_url = $row->failure_url ?? "";
      $environment = $row->environment ?? "";
      define('SECRET_KEY', $secretcard_key ? $row->secretcard_key : "");
      define('PUBLIC_KEY', $publiccard_key ? $row->publiccard_key : "");
      define('SUCCESS_URL', $success_url ? $row->success_url : "");
      define('FAILURE_URL', $failure_url ? $row->failure_url : "");
      define('THREEDS_KEY', $threed_key == "yes" ? "true" : "false");
      define('CAPTURE_KEY', $capture_key == "yes" ? "true" : "false");
      define('ENVIRONMENT',$environment == "sandbox" ? "true" : "false");
    endforeach;
  endif;

  $options = $wpdb->prefix . 'options';
  $optResults = $wpdb->get_results("SELECT * FROM $options where option_id = 1 ");
  if (!empty($optResults)) :
    foreach ($optResults as $rows) :
      $siteurl = $rows->option_value ?? "";
      define('SITE_URL', $siteurl ? $rows->option_value : "");
    endforeach;
  endif;
?>