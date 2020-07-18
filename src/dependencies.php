<?php

use Auryn\Injector;

use Vlog\Framework\Rendering\TemplateRenderer;
use Vlog\Framework\Rendering\TwigTemplateRendererFactory;
use Vlog\Framework\Rendering\TemplateDirectory;
use Vlog\FrontPage\Application\SubmissionsQuery;
use Vlog\FrontPage\Infrastructure\DbalSubmissionsQuery;
use Vlog\Framework\Dbal\DatabaseUrl;
use Vlog\Framework\Dbal\ConnectionFactory;
use Doctrine\DBAL\Connection;
use Vlog\Framework\Csrf\TokenStorage;
use Vlog\Framework\Csrf\SymfonySessionTokenStorage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Vlog\Framework\Csrf\StoredTokenReader;

$injector = new Injector();

$injector->alias(SubmissionsQuery::class, DbalSubmissionsQuery::class);
$injector->alias(TokenStorage::class, SymfonySessionTokenStorage::class);
$injector->alias(SessionInterface::class, Session::class);


$injector->share(SubmissionsQuery::class);


$templateDirectory = $injector->make(TemplateDirectory::class,[':rootDirectory' => ROOT_DIR]);
$storedTokenReader = $injector->make(StoredTokenReader::class);

$injector->delegate(
    TemplateRenderer::class,
    function () use ($injector, $templateDirectory, $storedTokenReader) : TemplateRenderer {
        $factory = new TwigTemplateRendererFactory($templateDirectory, $storedTokenReader );
        return $factory->create();
    }
);

$injector->define(
    DatabaseUrl::class,
    [':url' => 'sqlite:///' . ROOT_DIR . '/storage/db.sqlite3']
);
$injector->delegate(
    Connection::class,
    function () use ($injector){
        $factory = new ConnectionFactory($injector->make(DatabaseUrl::class));
        return $factory->create();
});


return $injector;
