<?php

namespace Core;


class Controller
{
	// Hàm render View
	public function render($view, $data = []): void
	{
		extract($data);
		$viewPath = '../app/Views/' . $view . '.php';
		require_once $viewPath;
	}
}
