<?php

  /**
  * Plugin Name: Xennox Get Engaged Now Pay Later - AC Event Tracking
  * Description: Custom Plugin to track events in AC wwhen user submits email on page 2
  * Version: 1.0.0
  */

  add_action( 'gform_post_paging_28', 'post_event_tracking', 10, 3 );
  function post_event_tracking( $form, $source_page_number, $current_page_number ) {
      if ( $current_page_number == 3 ) {
		  $email = rgpost( 'input_27' ); // email address input field number
          $curl = curl_init();
        	curl_setopt($curl, CURLOPT_URL, "https://trackcmp.net/event");
        	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($curl, CURLOPT_POST, true);
        	curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        	"actid" => "798912911",
        	"key" => "ddf8633022d114df19085c6f5d81a3dd748a9453",
        	"event" => "get_engaged_now_pay_later_step_2_submitted",
			    "eventdata" => "contact has viewed get-engaged-now-pay-later page and filled out form until step 2",
        	"visit" => json_encode(array(
        			// If you have an email address, assign it here.
        			"email" => $email,
        		)),
        	));

        	$result = curl_exec($curl);
        	if ($result !== false) {
        		$result = json_decode($result);
        		if ($result->success) {
//         			echo 'Success! ';
        		} else {
//         			echo 'Error! ';
        		}

        		echo $result->message;
        	} else {
//         		echo 'cURL failed to run: ', curl_error($curl);
        	}
      }
  }
?>
