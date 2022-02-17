function memberOfControl(config) {

    var defaultConfig = {
        id: '',
        add: {
            title: null,
            content: null
        },
        remove: {
            title: null,
            content: null
        }
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        _items: [],
        add() {
            const dialogRef = window.policy.alpineJs.modalService({
                title: this.config.add.title,
                contentRef: this.config.add.content
            });
            dialogRef.open(p => {
                if (p.confirm) {
                    this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:add-items`, p.items);
                }
            });
        },
        remove() {
            const dialogRef = window.policy.alpineJs.modalService({
                title: this.config.remove.title,
                contentRef: this.config.remove.content
            });
            dialogRef.open(p => {
                if (p) {
                    this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:remove-items`, this._items);
                }
            });
        },
        removeIsDisabled() { return this._items.length == 0; },
        selectedItemChanged(event) { this._items = event.detail.items; },
    };
}

export { memberOfControl };
