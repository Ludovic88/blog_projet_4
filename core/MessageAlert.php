<?php
namespace blogApp\core;


class MessageAlert
{
	/**
	 * Fonction qui verifie si une Session message alert existe
	 * si oui envoie la div conteneur du message alert
	 */
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

	/**
	 * Fonction qui envoie un message alert et demande de l'afficher
	 */
	static function messageType($type, $message){
		$_SESSION['succes'] = true;
		$_SESSION['class-message-succes'] = $type;
		$_SESSION['message-succes'] = $message;
	}

	/**
	 * Fonction qui detruit la session message alert
	 */
	static function destroyMessage(){
		unset($_SESSION['succes']);
		unset($_SESSION['class-message-succes']);
		unset($_SESSION['message-succes']);
	}
}
?>