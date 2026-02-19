<?php
declare(strict_types=1);

namespace Praktikant\Praktikum\classes;

class Html
{
    private string $title = '';

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function render(array $variables = []): never
    {
        $variables['html_title'] = $this->title;
        $variables['body_class'] = $variables['body_class'] ?? '';
        $variables['content'] = $variables['content'] ?? '';
        extract($variables);
        $html = require dirname(__FILE__, 3) . '/templates/html_main.php';
        exit;
    }
}
