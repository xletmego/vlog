<?php declare(strict_types=1);

namespace Vlog\Submission\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vlog\Framework\Rendering\TemplateRenderer;

final class SubmissionController{

    private TemplateRenderer $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer){
        $this->templateRenderer = $templateRenderer;
    }

    public function show(Request $request): Response{

        $content = $this->templateRenderer->render('Submission.html.twig');

        return new Response($content);
    }

    public function submit(Request $request){
        $content = $request->get('title') . ' - ' . $request->get('url');
        return new Response($content);
    }
}

