<?php

namespace Core\Components;

class Router
{
    public function dispatch(): void
    {
        // For Phase 1, just show a confirmation page.
        // Later, this will parse the URL and route to controllers.
        echo "<h1>Aunt Joy Router is working!</h1>";
    }
}
