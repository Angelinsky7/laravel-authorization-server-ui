function manySelector(config) {

    var initialized = false;

    var defaultConfig = {
        options: [],
        values: [],
    };

    var getItems = function (src, ids) {
        return src.filter(p => ids.includes(p.value.toString()));
    };

    var removeItems = function (src, ids) {
        for (let i = ids.length - 1; i >= 0; --i) {
            const itemToRemove = src.find(p => p.value == ids[i]);
            const indexToRemove = src.indexOf(itemToRemove);
            src.splice(indexToRemove, 1);
        }
    };

    // var inverter = function* (src) {
    //     for (let i = src.length - 1; i >= 0; --i) {
    //         yield src[i];
    //     }
    // }

    // var filterArrayWithArray = function (src, dest, config) {
    //     let allIds = dest.map(p => p.value);
    //     return src.filter(p => !allIds.includes(p.value));
    // };

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
        canAddAll() { return !this.available_options || this.available_options.length == 0; },
        canRemoveSelected() { return !this.selected_options_selected || this.selected_options_selected.length == 0; },
        canRemoveAll() { return !this.selected_options || this.selected_options.length == 0; },

        getIdOrNameFieldValue(prefix, index) { return `${prefix}[${index}]`; },

        init() {
            initialized = false;

            this.deselectAll();
            const valuesAsString = this.config.values.map(p => p.toString());
            this.available_options = this.config.options.filter(p => !valuesAsString.includes(p.value.toString()));
            this.selected_options = this.config.options.filter(p => valuesAsString.includes(p.value.toString()));

            initialized = true;
        },
        deselectAll() {
            this.available_options_selected = [];
            this.selected_options_selected = [];
        },
        addSelected() {
            const itemsToMove = getItems(this.available_options, this.available_options_selected);
            if (itemsToMove != null && itemsToMove.length != 0) {
                this.selected_options.push(...itemsToMove);
                removeItems(this.available_options, this.available_options_selected);
            }

            this.deselectAll();
        },
        addAll() {
            this.selected_options.push(...this.available_options);
            this.available_options = [];

            this.deselectAll();
        },
        removeSelected() {
            const itemsToMove = getItems(this.selected_options, this.selected_options_selected);
            if (itemsToMove != null && itemsToMove.length != 0) {
                this.available_options.push(...itemsToMove);
                removeItems(this.selected_options, this.selected_options_selected);
            }

            this.deselectAll();
        },
        removeAll() {
            this.available_options.push(...this.selected_options);
            this.selected_options = [];

            this.deselectAll();
        },

        setOptions(evt) {
            if (evt.detail.options != null) {
                const options = [...evt.detail.options];
                this.config.options = options;
                this.init();
            }
        }
    };

}

export { manySelector };
