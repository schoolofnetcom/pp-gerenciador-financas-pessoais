<?php

namespace SONFin\View;


use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class ViewRenderer implements ViewRendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twigEnviroment;


    /**
     * ViewRenderer constructor.
     */
    public function __construct(\Twig_Environment $twigEnviroment)
    {
        $this->twigEnviroment = $twigEnviroment;
    }

    public function render(string $template, array $context = []): ResponseInterface
    {
        $result = $this->twigEnviroment->render($template, $context);
        $response = new Response();
        $response->getBody()->write($result);
        return $response;
    }
}
