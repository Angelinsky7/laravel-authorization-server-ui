<!-- x-policy-ui-shared:outer-modal-layout -->
<div class="{{ $modal ? '' : 'py-12' }}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden {{ $modal ? '' : 'shadow-sm' }} sm:rounded-lg">
            <div class="p-6 bg-white {{ $modal ? '' : 'border-b' }}  border-gray-200">
                <div class="mt-10 sm:mt-0">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
