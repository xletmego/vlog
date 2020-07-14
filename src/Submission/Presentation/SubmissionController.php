<?php declare(strict_types=1);

namespace Vlog\Submission\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SubmissionController{

    public function show(Request $request): Response{
        $content = 'Submission controller';
        return new Response($content);
    }
}

