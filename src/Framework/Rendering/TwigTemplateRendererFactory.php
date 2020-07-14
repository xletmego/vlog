<?php declare(strict_types=1);

namespace Vlog\Framework\Rendering;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


final class TwigTemplateRendererFactory{
    private TemplateDirectory $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory){
        $this->templateDirectory = $templateDirectory;
    }

    public function create(): TwigTemplateRenderer{

        $templateDirectory = $this->templateDirectory->toString();
        $loader = new FilesystemLoader([$templateDirectory]);
        $environment = new Environment($loader, []);

        return  new TwigTemplateRenderer($environment);
    }
}