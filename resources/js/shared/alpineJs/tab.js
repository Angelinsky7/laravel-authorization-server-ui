function tab(config) {

    let tabItems = [];

    let main_zone = null;

    return {
        currentTabIndex: 0,
        headerBar: {
            left: 0,
            width: 0,
        },
        get tabItemsCount() { return tabItems.length; },
        init() {
            main_zone = this.$el.querySelector('main');
            this.$nextTick(() => this.changeTab(0));
        },
        register(tabItem, tabElement) {
            tabItems.push(tabItem);
            tabItem.tabIndexHeader = tabItems.length - 1;

            const mainTemplate = tabElement.querySelector('template#main');

            if (main_zone && mainTemplate) {
                const mainInstance = mainTemplate.content.cloneNode(true);
                const main = document.importNode(mainInstance, true)
                main_zone.appendChild(main);
                const newElement = main_zone.children[main_zone.children.length - 1];
                newElement.dataset.tabIndex = tabItem.tabIndexHeader;
                newElement.setAttribute('x-data', `window.policy.alpineJs.tabItem(${tabItem.tabIndexHeader})`);
            }
        },
        changeTab(tabIndex) {
            this.currentTabIndex = tabIndex;
            this._moveHeaderBar(tabItems[tabIndex]);
        },
        _moveHeaderBar(currentTabHeader) {
            this.headerBar.left = currentTabHeader.tabElement.offsetLeft;
            this.headerBar.width = currentTabHeader.tabElement.offsetWidth;
        }
    }
}

function tabItemRegister(tab) {
    return {
        tabIndexHeader: -1,
        tabElement: null,
        init() {
            this.tabElement = this.$el;
            tab.register(this, this.$el);
        },
        changeTab() {
            tab.changeTab(this.tabIndexHeader);
        },
        isActive(currentTabIndex) { return this.tabIndexHeader === currentTabIndex; }
    }
}

function tabItem(tabIndexConfig) {
    return {
        tabIndexMain: tabIndexConfig,
        visible(currentTabIndex) { return this.tabIndexMain === currentTabIndex; }
    }
}

export { tab, tabItemRegister, tabItem };
