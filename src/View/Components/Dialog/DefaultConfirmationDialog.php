<?php

namespace Darkink\AuthorizationServerUI\View\Components\Dialog;

use Illuminate\View\Component;

class DefaultConfirmationDialog extends Component
{

    public $title;
    public $content;
    public $icon;
    public $iconColor;
    public $cancelCaption;
    public $actionCaption;
    public $actionColor;

    public function __construct(
        string $title,
        string $content,
        string $icon = 'exclamation',
        string $iconColor = 'alert',
        string $cancelCaption = 'Cancel',
        string $actionCaption = 'Accept',
        string $actionColor = 'alert'
    ) {
        $this->title = $title;
        $this->content = $content;
        $this->icon = $icon;
        $this->iconColor = $iconColor;
        $this->cancelCaption = $cancelCaption;
        $this->actionCaption = $actionCaption;
        $this->actionColor = $actionColor;
    }

    public function render()
    {
        return view('policy-ui::components.dialog.default-confirmation-dialog');
    }
}
