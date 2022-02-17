function modalService(config) {

    var defaultWindow = `
<div x-data="window.policy.alpineJs.modal({id: '__MODAL_ID__'})"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-10"
    role="dialog" aria-modal="true" aria-labelledby="modal-headline">

   <div class="fixed inset-0 bg-gray-500 opacity-50 z-40"></div>

   <div class="fixed inset-0 z-50 grid justify-center content-center">
       <div class="bg-white shadow-lg rounded-lg sm:mt-8 sm:mb-8 overflow-hidden">
           <div class="flex flex-col h-full justify-between modal">
               <main id="content">
                   <div class="p-4 pb-0">
                       __HEADER__
                   </div>
               </main>
           </div>
       </div>
   </div>
</div>`;

    var defaultConfig = {
        window: defaultWindow,
        title: '',
        content: '',
        titleRef: null,
        contentRef: null,
        // footer: ''
    };

    var replaceWindowContent = (strWindow, key, value) => {
        return strWindow.replace(key, value);
    };

    var modals = document.getElementById('policy-ui-modals-container');
    var _modalRefCallback;
    var _modalEventBase;
    var _modalEventFunctionClose;

    var _getWindowContent = function (contentAsString, contentAsRef) {
        if (contentAsRef != null) {
            const contentTemplate = document.querySelector(`template#${contentAsRef}`);
            const templateInstance = contentTemplate.content.cloneNode(true);
            const result = document.importNode(templateInstance, true)
            return result;
        }
        const dummyDiv = document.createElement('div');
        dummyDiv.innerHTML = contentAsString;
        return dummyDiv;
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        modalRef: null,
        open(callback = null) {
            _modalRefCallback = callback;
            const nextModalId = window.policy.unobtrusive.nextModalId(modals);

            const windowContainerAsNode = document.createElement('div');
            let strWindow = this.config.window;
            strWindow = replaceWindowContent(strWindow, '__MODAL_ID__', nextModalId);
            strWindow = replaceWindowContent(strWindow, '__HEADER__', _getWindowContent(this.config.title, this.config.titleRef).innerHTML);
            windowContainerAsNode.innerHTML = strWindow;

            //strWindow = replaceWindowContent(strWindow, '__CONTENT__', _getWindowContent(this.config.content, this.config.contentRef));
            // strWindow = replaceWindowContent(strWindow, '__FOOTER__', this.config.footer);

            var mainAsNode = windowContainerAsNode.querySelector('main#content');
            mainAsNode.appendChild(_getWindowContent(this.config.content, this.config.contentRef));

            this.modalRef = window.policy.unobtrusive.createModal(windowContainerAsNode.childNodes[1], modals, nextModalId, true);
            _modalEventBase = `js-policy-ui-modal-${this.modalRef}`;
            _modalEventFunctionClose = p => this.close(p);
            window.addEventListener(`${_modalEventBase}-close`, _modalEventFunctionClose);
        },
        close(event) {
            window.removeEventListener(`${_modalEventBase}-close`, _modalEventFunctionClose);
            const result = event.detail.result;
            window.policy.unobtrusive.closeModal(this.modalRef);
            if (_modalRefCallback) { _modalRefCallback(result); }
        }
    }
}

export { modalService };