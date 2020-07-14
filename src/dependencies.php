<?php

use Auryn\Injector;

use Vlog\Framework\Rendering\TemplateRenderer;
use Vlog\Framework\Rendering\TwigTemplateRendererFactory;

$injector = new Injector();
$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector) : TemplateRenderer {
        $factory = new TwigTemplateRendererFactory();
        return $factory->create();
    }
);


return $injector;
