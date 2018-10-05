<?php
$access_token = '2ucJafrwHMEYSP2jBdz5C/iWzlBSVRMg4MiV0Zxo+b57F/6/FyKpDEH2AD309EgjVNJEWkSKufGBynh/PaIWa1lpSC9HahiRaFqi9mH4l/9c40wih8MuNKcJhKhLecSsKFmc61YBlEFnmnWkV19ogAdB04t89/1O/w1cDnyilFU=';
$currentDateTime = new DateTime();
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		//if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
		  if ($event['message']['text'] == '@BOT นายคือใคร' || $event['message']['text'] == '@BOT นายเป็นใคร' ) {
			// Get text sent
			$replyToken = $event['replyToken'];
                        $sir = $event['source']['type'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => 'ผมคือ MR.CSA ครับ ผมจะช่วยเหลือคุณเต็มความสามารถของผมครับ ' .  $sir
			];
		   }
		
		   elseif ($event['message']['text'] == '@BOT พี่ตี๋คือใคร' || $event['message']['text'] == '@BOT พี่ตี๋เป็นใคร' ) {
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => 'พี่ตี๋คือหัวหน้าผมครับ' 
			];
			  			   
		   }
		
		     elseif ( strpos($event['message']['text'], '@BOT hello') !== false || strpos($event['message']['text'], '@BOT สวัสดี' ) !== false )  {
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => 'currentDateTime->format('Y-m-d H:i:s') สวัสดีครับ ขอให้เป็นวันที่สดใสนะครับ , have a nice day' 
			];
			  			   
		   }
		
			 
                   else {
			
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => $text . '??  ยังไม่สามารถสนทนากับสิ่งที่คุณกล่าวมาได้ แต่อีกไม่นานผมจะสามารถเรียนรู้และโต้ตอบกับคุณได้ทุกประโยคครับ' 
			];
			
			
		   }
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . '2ucJafrwHMEYSP2jBdz5C/iWzlBSVRMg4MiV0Zxo+b57F/6/FyKpDEH2AD309EgjVNJEWkSKufGBynh/PaIWa1lpSC9HahiRaFqi9mH4l/9c40wih8MuNKcJhKhLecSsKFmc61YBlEFnmnWkV19ogAdB04t89/1O/w1cDnyilFU=');

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		//}
	}
}
echo "OK";
