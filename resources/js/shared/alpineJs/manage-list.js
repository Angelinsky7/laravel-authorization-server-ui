function manageList(config) {
    var defaultConfig = {
        items: []
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        items: [],
        init() {
            this.items = this.config.items;
        },

        getIdOrNameFieldValue(prefix, index) {
            return `${prefix}[${index}]`;
        },

        addItem() {
            this.items.push(null);
        },
        removeItem(index) {
            //TODO(demarco): It's working correctly this way... but why ???
            if (index <= this.items.length) {
                const nextItems = [...this.items];
                nextItems.splice(index, 1);
                this.items = [];
                this.$nextTick(() => {
                    this.items = nextItems;
                });
            }
        },
        updateItem(index, value) {
            this.items[index] = value;
        }
    };
}

export { manageList };
