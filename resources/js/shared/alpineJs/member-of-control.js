function memberOfListbox(config) {

    let defaultConfig = {
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
                    console.log('send event to', `x-policy-ui-shared:listbox-${this.config.id}:add-items`);
                    this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:add-items`, { items: p.items, preventDuplicates: true });
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
                    this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:remove-items`, { items: this._items });
                }
            });
        },
        removeIsDisabled() { return this._items.length == 0; },
        selectedItemChanged(event) { this._items = event.detail.items; }
    };
}

function memberOfControl(config) {

    let defaultConfig = {
        memberItems: [],
        remap: false
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        memberItems: null,
        remap: false,
        init() {
            this.memberItems = this.config.memberItems;
            this.remap = this.config.remap;
        },
        listboxInit(event) {
            if (this.remap) {
                event.detail.handle = true;
                event.detail.items = this.memberItems.filter(p => event.detail.values.includes(p.value));
            }
        }
    };
}

export { memberOfListbox, memberOfControl };
