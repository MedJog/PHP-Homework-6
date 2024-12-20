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

/* main.tpl */
class __TwigTemplate_e0abd865af2a73441ea0e85d1722adc1 extends Template
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
    <title>";
        // line 5
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "</title>
    <link rel=\"stylesheet\" href=\"../styles/style.css\">
</head>
<body>
    ";
        // line 9
        $this->loadTemplate("header.tpl", "main.tpl", 9)->display($context);
        // line 10
        echo "    
    <div class=\"main-content center\">
        ";
        // line 12
        $this->loadTemplate(($context["content_template_name"] ?? null), "main.tpl", 12)->display($context);
        // line 13
        echo "        ";
        $this->loadTemplate("sidebar.tpl", "main.tpl", 13)->display($context);
        // line 14
        echo "    </div>
   
    ";
        // line 16
        $this->loadTemplate("footer.tpl", "main.tpl", 16)->display($context);
        // line 17
        echo "</body>
</html>

";
    }

    public function getTemplateName()
    {
        return "main.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 17,  65 => 16,  61 => 14,  58 => 13,  56 => 12,  52 => 10,  50 => 9,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "main.tpl", "/data/mysite.local/src/Domain/Views/main.tpl");
    }
}
