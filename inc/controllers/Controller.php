<?php
namespace Danzerpress\Controllers;

use Danzerpress\Contexts\Danzerpress;
use Danzerpress\Contexts\DanzerpressPostContext;
use Timber;

class Controller {
    protected $context;
    protected $templates = [];

    public function __construct($template = null, $context = null) 
    {
        if ($template) {
            $this->set_templates($template);
        }

        $this->context = Danzerpress::get_context();
        $this->context['post'] = Timber::get_post(get_the_ID(), DanzerpressPostContext::class);
        $this->context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');

        if ($context) {
            $this->context = array_merge($context, $this->context);
        }
    }

    public function set_templates($templates) 
    {
        if (is_array($templates)) {
            $this->templates = array_merge($templates, $this->templates);
        } else {
            $this->templates[] = $templates;
        }
    }

    public function render() 
    {
        Timber::render($this->templates, $this->context, Danzerpress::get_ttl());
    }
}