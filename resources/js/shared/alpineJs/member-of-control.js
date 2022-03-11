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

    let innerListBoxItems = [];

    return {
        config: Object.assign({}, defaultConfig, config),
        memberOfListboxItems: [],
        add() {
            const dialogRef = window.policy.alpineJs.modalService({
                title: this.config.add.title,
                contentRef: this.config.add.content,
                data: {
                    exludeItems: [...this.memberExcludeItems, ...innerListBoxItems.map(p => p.value)]
                }
            });
            dialogRef.open(p => {
                if (p.confirm) {
                    // console.log('send event to', `x-policy-ui-shared:listbox-${this.config.id}:add-items`);
                    // this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:add-items`, { items: p.items, preventDuplicates: true });
                    this.onAddItems(p.items);
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
                    // this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:remove-items`, { items: this.memberOfListboxItems });
                    this.onRemoveItems();
                }
            });
        },

        onAddItems(items) {
            this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:add-items`, { items: items, preventDuplicates: true });
        },
        onRemoveItems() {
            this.$dispatch(`x-policy-ui-shared:listbox-${this.config.id}:remove-items`, { items: this.memberOfListboxItems });
        },

        removeIsDisabled() { return this.memberOfListboxItems.length == 0; },
        selectedItemChanged(event) { this.memberOfListboxItems = event.detail.items; },
        storeListboxItems(event) { innerListBoxItems = event.detail.items; }
    };
}

function memberOfControl(config) {

    let defaultConfig = {
        memberItems: [],
        memberExcludeItems: [],
        remap: false
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        memberItems: null,
        memberExcludeItems: null,
        remap: false,
        init() {
            this.memberItems = this.config.memberItems;
            this.memberExcludeItems = this.config.memberExcludeItems;
            this.remap = this.config.remap;
        },
        listboxInit(event) {
            if (this.remap) {
                event.detail.handle = true;
                event.detail.items = this.memberItems.filter(p => event.detail.values.map(a => `${a}`).includes(`${p.value}`));
            }
            // console.log('remap', this.remap, this.memberItems, event.detail.items, event.detail.values);
        },
        // dialogListboxInit(event) {
        //     if (this.memberExcludeItems && this.memberExcludeItems.length != 0) {
        //         event.detail.items = this.memberItems.filter(p => this.memberExcludeItems.map(a => `${a}`).includes(`${p.value}`));
        //     }
        // }
    };
}

export { memberOfListbox, memberOfControl };
