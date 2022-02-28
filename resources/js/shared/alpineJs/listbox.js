function listbox(config) {

    var uniqueIndex = 0;

    var defaultConfig = {
        items: []
    };

    var lastSelectedEventItemsSent = [];

    return {
        config: Object.assign({}, defaultConfig, config),
        items: [],
        selected: [],
        init() {
            this.items = this._remapItems(this.config.items);
            this._onItemsChanged();

            this.$nextTick(() => {
                let evt = { handle: false, items: this.items, values: this.config.items };
                this.$dispatch('initialize', evt);
                if (evt.handle) {
                    this.items = this._remapItems(evt.items);
                    this._onItemsChanged();
                }
            });
        },

        isItemSelected(item) {
            return this.selected.some(p => p.value == item.value);
        },

        _remapItems(src) {
            return src.filter(p => p.item).map(p => ({ value: p.value, item: p.item, index: uniqueIndex++ }));
        },

        _onSelectedItemChanged() {
            if (JSON.stringify(lastSelectedEventItemsSent) !== JSON.stringify(this.selected)) {
                this.$dispatch('selected-items', { items: this.selected });
                lastSelectedEventItemsSent = this.selected;
            }
        },
        _onItemsChanged() {
            this.$dispatch('items-changed', { items: this.items });
        },

        isItemDisabled(item) { return false; },

        getIdOrNameFieldValue(prefix, index) {
            return `${prefix}[${index}]`;
        },

        addItems(itemsToAdd) {
            let items = itemsToAdd.items;
            if (itemsToAdd.preventDuplicates) {
                items = items.filter(p => !this.items.map(a => a.value).includes(p.value));
            }
            items = items.map(p => ({ value: p.value, item: p.item, index: uniqueIndex++ }));
            this.items.push(...items);
            this._onItemsChanged();
        },
        removeItems(itemsToRemove) {
            const items = itemsToRemove.items;

            if (items != null && items.length != 0) {
                for (let i = items.length - 1; i >= 0; --i) {
                    const itemToRemove = this.items.find(p => p.value === items[i].value);
                    if (itemToRemove != null) {
                        const indexToRemove = this.items.indexOf(itemToRemove);
                        this.items.splice(indexToRemove, 1);
                    }
                }
                this._onItemsChanged();
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
