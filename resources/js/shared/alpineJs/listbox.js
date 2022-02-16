function listbox(config) {

    var uniqueIndex = 0;

    var defaultConfig = {
        items: [],
    };

    var lastSelectedEventItemsSent = [];

    return {
        config: Object.assign({}, defaultConfig, config),
        items: [],
        selected: [],
        init() {
            this.items = this.config.items.map(p => ({ value: p.value, item: p.item, index: uniqueIndex++ }));
        },

        isItemSelected(item) {
            return this.selected.some(p => p.value == item.value);
        },

        _onSelectedItemChanged() {
            if (JSON.stringify(lastSelectedEventItemsSent) !== JSON.stringify(this.selected)) {
                this.$dispatch('selected-items', { items: this.selected });
                lastSelectedEventItemsSent = this.selected;
            }
        },

        isItemDisabled(item) { return false; },

        getIdOrNameFieldValue(prefix, index) {
            return `${prefix}[${index}]`;
        },

        addItems(itemsToAdd) {
            this.items.push(...itemsToAdd);
        },
        removeItems(itemsToRemove) {
            if (itemsToRemove != null && itemsToRemove.length != 0) {
                for (let i = itemsToRemove.length - 1; i >= 0; --i) {
                    const itemToRemove = this.items.find(p => p.value === itemsToRemove[i].value);
                    if (itemToRemove != null) {
                        const indexToRemove = this.items.indexOf(itemToRemove);
                        this.items.splice(indexToRemove, 1);
                    }
                }
            }
        },
        updateItem(index, value) {
            this.items[index].value = value;
        },

        toggleItem(event, index, item) {
            if (event.ctrlKey) {
                if (this.isItemSelected(item)) {
                    this.deselectItem(item);
                } else {
                    this.selectItem(item);
                }
            } else {
                this.selected = [item];
                this._onSelectedItemChanged();
            }
        },

        selectItem(item) {
            this.selected.push(item);
            this._onSelectedItemChanged();
        },
        deselectItem(item) {
            const indexOfItem = this.selected.indexOf(item);
            if (indexOfItem >= 0) {
                this.selected.splice(indexOfItem, 1);
            }
            this._onSelectedItemChanged();
        },
        selectAllItems() {
            this.selected = [...this.items];
            this._onSelectedItemChanged();
        },
        deselectAllItems() {
            this.selected = [];
            this._onSelectedItemChanged();
        },

    };
}

export { listbox };
