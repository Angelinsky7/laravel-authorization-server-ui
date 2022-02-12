function manySelector(config) {

    var initialized = false;

    var defaultConfig = {
        options: [],
        valueIds: [],
    };

    var getItemFrom = function (src, idsToRemove, config) {
        return src.filter(p => idsToRemove.includes(p.value.toString()));
    };

    var removeItemFrom = function (src, idsToRemove, config) {
        for (let i = idsToRemove.length - 1; i >= 0; --i) {
            let itemToRemove = src.find(p => p.value == idsToRemove[i]);
            let indexToRemove = src.indexOf(itemToRemove);
            src.splice(indexToRemove, 1);
        }
    };

    var filterArrayWithArray = function (src, dest, config) {
        let allIds = dest.map(p => p.value);
        return src.filter(p => !allIds.includes(p.value));
    };

    // var moveArrayToArray = fucntion(src, dest, config){

    // }

    return {
        config: this.config = Object.assign({}, defaultConfig, config),
        // panelVisible: false,
        // search: '',

        available_options: [],
        selected_options: [],
        available_options_selected: [],
        selected_options_selected: [],

        canAddSelected() { return !this.available_options_selected || this.available_options_selected.length == 0; },
        canAddAll() { return !this.options || this.options.length == 0; },
        canRemoveSelected() { return !this.selected_options_selected || this.selected_options_selected.length == 0; },
        canRemoveAll() { return !this.values || this.values.length == 0; },

        getIdOrNameFieldValue(prefix, index) {
            return `${prefix}[${index}]`;
        },

        init() {

            initialized = true;
        },
        addSelected() {
            if (!this.available_options_selected || this.available_options_selected.length == 0) { return; }
            let itemsToMove = getItemFrom(this.options, this.available_options_selected, this.config);
            this.values.push(...itemsToMove);
            removeItemFrom(this.options, this.available_options_selected, this.config);
            this.available_options_selected = [];
        },
        addAll() {
            if (!this.options || this.options.length == 0) { return; }
            let allIds = this.options.map(p => this.p.value.toString());
            let itemsToMove = getItemFrom(this.options, allIds, this.config);
            this.values.push(...itemsToMove);
            removeItemFrom(this.options, allIds, this.config);
        },
        removeSelected() {
            if (!this.selected_options_selected || this.selected_options_selected.length == 0) { return; }
            let itemsToMove = getItemFrom(this.values, this.selected_options_selected, this.config);
            this.options.push(...itemsToMove);
            removeItemFrom(this.values, this.selected_options_selected, this.config);
            this.selected_options_selected = [];
        },
        removeAll() {
            if (!this.values || this.values.length == 0) { return; }
            let allIds = this.values.map(p => this.p.value.toString());
            let itemsToMove = getItemFrom(this.values, allIds, this.config);
            this.options.push(...itemsToMove);
            removeItemFrom(this.values, allIds, this.config);
        },

        setOptions(evt) {
            if (evt.detail.scopes != null) {
                let newOptions = evt.detail.scopes.map(p => ({ value: p.id, caption: p.display_name }));
                console.log('setOptions', this.values, this.config.values);
                this.options = filterArrayWithArray(newOptions, this.values, this.config);
            }
        }
    };

}

export { manySelector };
