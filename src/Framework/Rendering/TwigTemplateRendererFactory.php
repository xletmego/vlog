<?php declare(strict_types=1);

namespace Vlog\Framework\Rendering;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use Vlog\Framework\Csrf\StoredTokenReader;


final class TwigTemplateRendererFactory{

    private TemplateDirectory $templateDirectory;
    private StoredTokenReader $storedTokenReader;

    public function __construct(TemplateDirectory $templateDirectory, StoredTokenReader $storedTokenReader){
        $this->templateDirectory = $templateDirectory;
        $this->storedTokenReader = $storedTokenReader;
    }

    public function create(): TwigTemplateRenderer{

        $templateDirectory = $this->templateDirectory->toString();
        $loader = new FilesystemLoader([$templateDirectory]);
        $environment = new Environment($loader, []);

        $environment->addFunction(
            new TwigFunction('get_token', function (string $key):string {
                $token = $this->storedTokenReader->read($key);
                return $token->toString();
            })
        );

        return  new TwigTemplateRenderer($environment);
    }
}