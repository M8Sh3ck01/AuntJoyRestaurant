<?php

namespace Core\Components;

class Controller
{
    protected string $layout = 'layout_main.php'; // default layout

    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    protected function render(string $view, array $params = []): void
    {
        // Make $params available as individual variables in the view
        extract($params, EXTR_SKIP);

        // Build path to view file (relative to project root)
        $viewFile = __DIR__ . '/../../' . $view;

        ob_start();
        if (is_file($viewFile)) {
            require $viewFile;
        } else {
            echo "View not found: " . htmlspecialchars($viewFile);
        }
        $content = ob_get_clean();

        // Include layout and inject $content
        $layoutFile = __DIR__ . '/../templates/' . $this->layout;
        if (is_file($layoutFile)) {
            require $layoutFile;
        } else {
            // Fallback: no layout, just echo content
            echo $content;
        }
    }
}
