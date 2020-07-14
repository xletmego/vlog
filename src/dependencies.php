<?php

use Auryn\Injector;

use Vlog\Framework\Rendering\TemplateRenderer;
use Vlog\Framework\Rendering\TwigTemplateRendererFactory;
use Vlog\Framework\Rendering\TemplateDirectory;

$injector = new Injector();
$templateDirectory = $injector->make(TemplateDirectory::class,[':rootDirectory' => ROOT_DIR]);
$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector, $templateDirectory) : TemplateRenderer {
        $factory = new TwigTemplateRendererFactory($templateDirectory);
        return $factory->create();
    }
);


return $injector;
