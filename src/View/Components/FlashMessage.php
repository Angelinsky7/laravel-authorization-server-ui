<?php

namespace Darkink\AuthorizationServerUI\View\Components;

use Darkink\AuthorizationServer\Helpers\FlashMessage as HelpersFlashMessage;
use Darkink\AuthorizationServer\Helpers\FlashMessageSize;
use Illuminate\View\Component;

class FlashMessage extends Component
{
    public string $message;
    public bool $autoclose;
    public int $duration;
    public FlashMessageSize $size;
    public HelpersFlashMessage | null $item = null;
    public FlashMessageType $type = FlashMessageType::NONE;

    /**
     * Class constructor.
     */
    public function __construct(bool $autoclose = true, int $duration = 3000, FlashMessageSize | string $size = 'basic')
    {
        $this->message = '';
        $this->autoclose = $autoclose;
        $this->duration = $duration;
        $this->size = is_string($size) ? FlashMessageSize::tryFrom($size) : $size;

        if (session('success_message')) {
            $this->getDataFromSession('success_message');
            $this->type = FlashMessageType::SUCCESS;
        } elseif (session('error_message')) {
            $this->getDataFromSession('error_message');
            $this->type = FlashMessageType::ERROR;
        } elseif (session('warning_message')) {
            $this->getDataFromSession('warning_message');
            $this->type = FlashMessageType::WARNING;
        }
    }

    protected function getDataFromSession(string $key)
    {
        $session_item = session($key);
        if (is_string($session_item)) {
            $this->message = $session_item;
        } else if ($session_item instanceof HelpersFlashMessage) {
            $this->item = $session_item;
            $this->message = $this->item->message;
            $this->autoclose = $this->item->autoclose;
            $this->duration = $this->item->duration;
            $this->size = $this->item->size;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('policy-ui::components.flash-message');
    }
}

enum FlashMessageType: string
{
    case NONE = 'none';
    case SUCCESS = 'success';
    case ERROR = 'error';
    case WARNING = 'warning';
}
