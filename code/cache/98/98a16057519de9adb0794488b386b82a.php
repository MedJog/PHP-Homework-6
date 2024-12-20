<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* error.tpl */
class __TwigTemplate_850354b99fa64946ffe1bc5ca665a076 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Ошибка ";
        // line 5
        echo twig_escape_filter($this->env, ($context["errorCode"] ?? null), "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" href=\"../styles/style.css\">
</head>
<body>
    <div style=\"text-align: center; margin-top: 50px;\">
        <h1>Ошибка ";
        // line 10
        echo twig_escape_filter($this->env, ($context["errorCode"] ?? null), "html", null, true);
        echo "</h1>
        <p>";
        // line 11
        echo twig_escape_filter($this->env, ($context["errorMessage"] ?? null), "html", null, true);
        echo "</p>
        <a href=\"/\" style=\"color: blue; text-decoration: underline;\">Вернуться на главную</a>
    </div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "error.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 11,  51 => 10,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "error.tpl", "/data/mysite.local/src/Domain/Views/error.tpl");
    }
}
