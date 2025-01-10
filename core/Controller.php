<?php

namespace Core;


class Controller
{
	protected function render(string $view, array $data = []): void
	{
		echo Blade::getInstance()->render($view, $data);
	}
}
