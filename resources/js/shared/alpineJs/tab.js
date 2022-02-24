function tab(config) {

    let tabIndexes = 0;
    let tabItems = [];

    return {
        currentTabIndex: 0,
        get tabItemsCount() { return tabItems.length; },
        register(tabItem, tabElement) {
            tabItems.push(tabItem);
            tabItem.tabIndexHeader = this.getNextTabIndex();

            const main_zone = this.$el.querySelector('main');
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
        },
        getNextTabIndex() {
            return tabIndexes++;
        }
    }
}

function tabItemRegister(tab) {
    return {
        tabIndexHeader: -1,
        init() {
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
