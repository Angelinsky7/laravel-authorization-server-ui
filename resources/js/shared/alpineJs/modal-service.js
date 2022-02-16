function modalService(config) {

    var defaultWindow = `<div x-data="{ show: false }" x-show="show" x-cloak>
    <div class="fixed inset-0 bg-gray-500 opacity-50">
        <div class="bg-white shadow-md p-4 max-w-sm h-48 m-auto rounded-md fixed inset-0">
            <div class="flex flex-col h-full justify-between">
                <header>
                    __HEADER__
                </header>
                <main class="mb-4">
                    __BODY__
                </main>
                <footer>
                    __FOOTER__
                </footer>
            </div>
        </div>
    </div>
</div>`;

    var defaultConfig = {
        window: defaultWindow,
        title: '',
        content: '',
        footer: ''
    };

    var replaceWindowContent = (strWindow, key, value) => {
        return strWindow.replace(key, value);
    };

    var modals = document.getElementById('policy-ui-modals-container');

    return {
        config: Object.assign({}, defaultConfig, config),
        open(callback = null) {
            let strWindow = this.config.window;
            strWindow = replaceWindowContent(strWindow, '__HEADER__', this.config.title);
            strWindow = replaceWindowContent(strWindow, '__BODY__', this.config.content);
            strWindow = replaceWindowContent(strWindow, '__FOOTER__', this.config.footer);

            window.policy.unobtrusive.createModal(strWindow, modals);

            const dialogResult = false;
            if (callback) { callback(dialogResult); }
        }
    }
}

export { modalService };
