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

/* sidebar.tpl */
class __TwigTemplate_c1c602157fbe8d6c0409b030faeb34cc extends Template
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
        echo "<aside class=\"sidebar\">
    <div class=\"sidebar-content\">
        <h2 class=\"sidebar-title\">Навигация</h2>
        <ul class=\"sidebar-list\">
            <li class=\"sidebar-li\"><a href=\"/page/index\">Главная страница</a></li>
            <li class=\"sidebar-li\"><a href=\"/user/index\">Список пользователей</a></li>
            <li class=\"sidebar-li\"><a href=\"/about\">О приложении</a></li>
        </ul>
    </div>
</aside>";
    }

    public function getTemplateName()
    {
        return "sidebar.tpl";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "sidebar.tpl", "/data/mysite.local/src/Domain/Views/sidebar.tpl");
    }
}
