<?php //controller principal

class Controller
{

	protected $template = 'frontend/template';

	public function render($path, $vars){
		extract($vars);
		ob_start();
		require('../views/' . $path . '.php');
		$content = ob_get_clean();
		require('../views/' . $this->template . '.php');
	}
}