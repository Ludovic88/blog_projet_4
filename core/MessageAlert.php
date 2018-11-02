<?php
namespace blogApp\core;


class MessageAlert
{
	static function verifySessionAlert()
	{
		if (isset($_SESSION['succes'])){
				?>
                <div class="alert alert-<?= $_SESSION['class-message-succes']; ?>" role="alert">
                    <?= $_SESSION['message-succes'] ?>
                </div>
				<?php
		}
	}

	static function messageType($type, $message){
		$_SESSION['succes'] = true;
		$_SESSION['class-message-succes'] = $type;
		$_SESSION['message-succes'] = $message;
	}

	static function destroyMessage(){
		unset($_SESSION['succes']);
		unset($_SESSION['class-message-succes']);
		unset($_SESSION['message-succes']);
	}
}
?>