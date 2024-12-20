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

/* header.tpl */
class __TwigTemplate_d3778f55db5d3188250e674107677ddb extends Template
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
        echo "<header class=\"header center\">
    <div class=\"header-item\">
        <h1 class=\"caption\">Моё Приложение</h1>
    </div>
    <div class=\"header-item\">
        <p class=\"time\">Текущее время: ";
        // line 6
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "H:i:s"), "html", null, true);
        echo "</p>
    </div>
</header>";
    }

    public function getTemplateName()
    {
        return "header.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.tpl", "/data/mysite.local/src/Domain/Views/header.tpl");
    }
}
