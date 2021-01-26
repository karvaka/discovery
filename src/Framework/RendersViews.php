<?php declare(strict_types=1);

namespace App\Framework;

trait RendersViews
{
    public function render(string $view, array $data = [], ?string $layout = null): View
    {
        $view = new View($view, $this->getViewsBasePath(), $data);

        $layout = $layout ?? $this->getLayout();

        if (! is_null($layout)) {
            return new View($layout, $this->getViewsBasePath(), [
                'content' => $view
            ]);
        }

        return $view;
    }

    public abstract function getViewsBasePath(): string;

    public function getLayout(): ?string
    {
        return null;
    }
}
