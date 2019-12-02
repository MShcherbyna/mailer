<?php
namespace App\Src;

class View
{
    public function render(string $template_name, array $data = []): void
    {
        if (is_array($data)) extract($data);

        require __DIR__ . '/../../public/view/' . $template_name . '.php';
    }

    public function add_template(string $template_name, array $data = []): string
    {
        if (is_array($data)) extract($data);

        $html_file = file_get_contents(__DIR__ . '/../../public/mail/' . $template_name . '.php');

        return str_replace(
            ["{Name}"],
            [$name],
            $html_file
        );
    }
}
