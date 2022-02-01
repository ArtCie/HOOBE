<?php
class AppController
{
    private $request;
    private $url;

    public function __construct()
    {
        $this->url = "http://$_SERVER[HTTP_HOST]";
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function redirect(string $path): void
    {
        header("Location: $this->url/$path");
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isPut(): bool
    {
        return $this->request === 'PUT';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}