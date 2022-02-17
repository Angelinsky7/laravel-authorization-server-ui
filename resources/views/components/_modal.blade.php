<div x-data="{ show: false }" x-show="show" x-cloak>
    <div class="fixed inset-0 bg-gray-500 opacity-50">
        <div class="bg-white shadow-md p-4 max-w-sm h-48 m-auto rounded-md fixed inset-0">
            <div class="flex flex-col h-full justify-between">
                <header>
                    {{ $title }}
                </header>
                <main class="mb-4">
                    {{ $body }}
                </main>
                <footer>
                    {{ $footer }}
                </footer>
            </div>
        </div>
    </div>
</div>
