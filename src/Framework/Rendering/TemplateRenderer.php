<?php

namespace Vlog\Framework\Rendering;

interface TemplateRenderer{
    public function render(string $template, array $data = []): string;
}