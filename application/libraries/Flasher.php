<?php 
/**
 * <!-- Flasher.php -->
 */
class Flasher{
	
	public static function setFlash($for, $icon, $title, $message){
		$_SESSION['flash'] = array(
			'for' => $for,
			'icon' => $icon, 
			'title' => $title, 
			'message' => $message
		);
	}

	public static function getFlash(){
		if (isset($_SESSION['flash'])) {
			return $_SESSION['flash'];
		}
	}
	public static function unsetFlash(){
		unset($_SESSION['flash']);
	}

}