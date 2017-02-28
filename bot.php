<?php
$access_token = '2ucJafrwHMEYSP2jBdz5C/iWzlBSVRMg4MiV0Zxo+b57F/6/FyKpDEH2AD309EgjVNJEWkSKufGBynh/PaIWa1lpSC9HahiRaFqi9mH4l/9c40wih8MuNKcJhKhLecSsKFmc61YBlEFnmnWkV19ogAdB04t89/1O/w1cDnyilFU=';

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
		  if ($event['message']['text'] == 'คุณคือใคร') {
			// Get text sent
			$replyToken = $event['replyToken'];
                        $sir = $event['source']['type'];
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => 'ผมคือ MR.CCA ครับ ผมจะช่วยเหลือคุณเต็มความสามารถของผมครับ คุณ ' .  $sir
			];
		   }
		
		   elseif ($event['message']['text'] == 'พี่ตี๋คือใคร') {
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => 'พี่ตี๋คือหัวหน้าผมครับ' 
			];
			  			   
		   }
		
		     elseif ( strpos($event['message']['text'], 'สมพร') !== false || strpos($event['message']['text'], 'ปุ๊') !== false )  {
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => 'สำรหับผมแล้ว คำว่า สมพร หรือ ปุ๊ คือคำหยาบนะครับ ไม่ควรกล่าวถึงสองคำนี้ เพราะ ปุ๊มันคือนักรักร้อยบาท ชอบฟันแล้วทิ้ง' 
			];
			  			   
		   }
		
			 
                   else {
			
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];
			$messages = [
				'type' => 'text',
				'text' => $text . '  ขอโทษที่ยังไม่สามารถโต้ตอบกับบทสนทนานี้ได้นะครับ แต่อีกไม่นานผมจะเก่งกว่านี้ครับ' 
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
