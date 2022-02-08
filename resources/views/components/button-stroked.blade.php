<button @class([
    'bg-transparent font-semibold hover:text-white py-2 px-4 border hover:border-transparent rounded ml-1',
    'hover:bg-blue-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::BLUE,
    'text-blue-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::BLUE,
    'border-blue-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::BLUE,
    'hover:bg-green-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::GREEN,
    'text-green-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::GREEN,
    'border-green-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::GREEN,
    'hover:bg-red-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::RED,
    'text-red-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::RED,
    'border-red-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::RED,
    'hover:bg-yellow-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::YELLOW,
    'text-yellow-700' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::YELLOW,
    'border-yellow-500' => $color == \Darkink\AuthorizationServerUI\View\Components\Shared\ButtonColor::YELLOW,
]) type="{{ $type }}">
    {{ $caption }}
</button>
