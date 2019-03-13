<?php

class telegram
{
    function __construct()
    {
        global $TelegramAPI;
        require_once("./application/include/telegramapi.php");
        $TelegramAPI = new TelegramAPI(TelegramBotToken);
    }
	function mkwebhook()
    {
        global $TelegramAPI,$database,$website_setting,$news,$videos;
        $TelegramAPI->getdata_enable();
        if(!empty($TelegramAPI->ChatID()))
        {
            $chat_id = $TelegramAPI->ChatID();
            if(preg_match('/^[0-9]+$/',$chat_id))
            {
				$message = $chat_id;
				$option = array(array($TelegramAPI->buildInlineKeyBoardButton("MasterkinG32.CoM", "https://masterking32.com")));
				$keyb = $TelegramAPI->buildInlineKeyBoard($option);
				$content = ['chat_id' => $chat_id ,'reply_markup' => $keyb, 'text' => $message,'parse_mode'=>'html'];
				$TelegramAPI->sendMessage($content);
            }
        }else{

        }
        exit();
    }
    public function newmigration()
    {

        $message = "Have new migration on masterwow : https://migration.masterwow.ir";
        $this->sendMessage(TelegramBotUSERID,$message);
    }
    public function sendMessage($chat_id,$message,$links = array())
    {
        global $TelegramAPI;
        if(!empty($chat_id) && !empty($message))
        {
            $option = array();
            foreach($links as $alink)
            {
                if(!empty($alink["0"]) && !empty($alink["1"]))
                {
                    array_push($option,array($TelegramAPI->buildInlineKeyBoardButton($alink["0"],$alink["1"])));
                }
            }
            $keyb = $TelegramAPI->buildInlineKeyBoard($option);
            $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $message,'parse_mode'=>'html'];
			$TelegramAPI->sendMessage($content);
        }
    }
}
$telegram = new telegram();
?>