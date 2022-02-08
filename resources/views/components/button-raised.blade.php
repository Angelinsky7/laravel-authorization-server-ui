<button @class([
    'text-white font-bold py-2 px-4 rounded',
    'bg-blue-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::BLUE,
    'hover:bg-blue-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::BLUE,
    'bg-green-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::GREEN,
    'hover:bg-green-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::GREEN,
    'bg-red-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::RED,
    'hover:bg-red-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::RED,
    'bg-yellow-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::YELLOW,
    'hover:bg-yellow-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::YELLOW,
]) type="{{ $type }}">
    {{ $caption }}
</button>
