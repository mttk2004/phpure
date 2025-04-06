<?php

namespace Core;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Controller
{
    /**
     * Render a view
     *
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    protected function render(string $view, array $data = []): void
    {
        echo Twig::getInstance()->render($view . '.html.twig', $data);
    }
}
