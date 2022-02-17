<!-- x-policy-ui-shared:outer-modal-layout -->
@php
$LAYOUTSIZE = \Darkink\AuthorizationServerUI\View\Components\Shared\LayoutSize::class;
@endphp
<div class="{{ $modal ? '' : 'py-12' }}">
    <div @class([
        'max-w-7xl mx-auto ',
        'sm:px-4 lg:px-6' => $paddingExternalSize == $LAYOUTSIZE::Small,
        'sm:px-6 lg:px-8' => $paddingExternalSize == $LAYOUTSIZE::Normal,
        'sm:px-10 lg:px-12' => $paddingExternalSize == $LAYOUTSIZE::Big,
    ])>
        <div class="bg-white overflow-hidden {{ $modal ? '' : 'shadow-sm' }} sm:rounded-lg">
            <div @class([
                'bg-white border-gray-200',
                'border-b' => !$modal,
                'p-4' => $paddingSize == $LAYOUTSIZE::Small,
                'p-6' => $paddingSize == $LAYOUTSIZE::Normal,
                'p-10' => $paddingSize == $LAYOUTSIZE::Big,
            ])>
                <div class="mt-10 sm:mt-0">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
