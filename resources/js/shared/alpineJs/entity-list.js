function dialogEntityListListBox(config) {

    let defaultValue = {
        memberExcludeItems: [],
        excludeAlreadyAddedItems: false,
    };

    return {
        dialogEntityListboxConfig: Object.assign({}, defaultValue, config),
        search: '',
        modalItems: [],
        selectedItemChanged(event) { this.modalItems = event.detail.items; },
        addButtonDisabled() { return this.modalItems.length == 0; },
        dialogListboxInit(event) {
            if (this.dialogEntityListboxConfig.excludeAlreadyAddedItems) {
                event.detail.handle = true;
                event.detail.items = event.detail.items.filter(p => !this.dialogEntityListboxConfig.memberExcludeItems.map(a => `${a}`).includes(`${p.value}`));
            }
        }
    }
}

export { dialogEntityListListBox };
