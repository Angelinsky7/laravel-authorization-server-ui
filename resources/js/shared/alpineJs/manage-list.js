function manageList(config) {

    var uniqueIndex = 0;

    var defaultConfig = {
        items: []
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        items: [],
        init() {
            this.items = this.config.items.map(p => ({ value: p, index: uniqueIndex++ }));
        },

        getIdOrNameFieldValue(prefix, index) {
            return `${prefix}[${index}]`;
        },

        addItem() {
            this.items.push({ value: null, index: uniqueIndex++ });
        },
        removeItem(index) {
            if (index <= this.items.length) {
                this.items.splice(index, 1);
            }
        },
        updateItem(index, value) {
            this.items[index].value = value;
        }
    };
}

export { manageList };
