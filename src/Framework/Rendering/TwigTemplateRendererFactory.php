<?php declare(strict_types=1);

namespace Vlog\Framework\Rendering;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


final class TwigTemplateRendererFactory{

    public function create(): TwigTemplateRenderer{
        $loader = new FilesystemLoader('');
        $environment = new Environment($loader, []);
        return  new TwigTemplateRenderer($environment);
    }
}