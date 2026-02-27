<?php
declare(strict_types=1);

namespace App\Infrastructure\Helpers;

final class ViewHelper
{
    public static function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../../Views/' . $view . '.view.php';
        $layoutPath = __DIR__ . '/../../Views/layout/layout.view.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            require __DIR__ . '/../../Views/errors/404.view.php';
            return;
        }

        extract($data);

        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        require $layoutPath;
    }
}