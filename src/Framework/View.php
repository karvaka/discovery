<?php declare(strict_types=1);

namespace App\Framework;

use Throwable;

class View
{
    use RendersViews;

    public function __construct(
        private string $view,
        private string $path,
        private array $data = []
    )
    {
    }

    public function getViewsBasePath(): string
    {
        return $this->path;
    }

    public function getViewPath(): string
    {
        return rtrim($this->path, '/\\') . '/' . $this->view . '.php';
    }

    public function fetch(): string
    {
        $viewPath = $this->getViewPath();

        if (! is_file($viewPath)) {
            throw new ViewNotFoundException('View [' . $this->view . '] does not exist.');
        }

        try {
            ob_start();
            $this->includeView($viewPath, $this->data);
            $content = ob_get_clean();
        } catch (Throwable $e) {
            ob_end_clean();
            throw $e;
        }

        return $content;
    }

    private function includeView(string $view, array $data): void
    {
        extract($data);
        include func_get_arg(0);
    }

    public function __toString(): string
    {
        return $this->fetch();
    }
}
