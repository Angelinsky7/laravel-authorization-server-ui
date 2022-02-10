function manySelector(config) {

    var initialized = false;

    var defaultConfig = {
        options: [],
        values: [],
        // autoActiveFirstOption: false,
        // emptyOptionsMessage: null,
        // filterValue(value) { return value.toString().toLowerCase(); },
        // filterOptions(options, filterValue) { return options.filter(p => this.getOptionCaption(p).toLowerCase().includes(filterValue)); },
        getOptionCaption(option) { return option.caption ?? option; },
        getOptionValue(option) { return option.value ?? option; },
        // isOptionDisabled(option) { return option.disabled ?? false; },
        // isOptionActive(focusedOptionIndex, index) { return focusedOptionIndex === index; },
        // findOptionByValue(options, value) { return options.find(p => this.getOptionValue(p) == value); }
    };

    var getItemFrom = function (src, idsToRemove, config) {
        return src.filter(p => idsToRemove.includes(config.getOptionValue(p).toString()));
    };

    var removeItemFrom = function (src, idsToRemove, config) {
        for (let i = idsToRemove.length - 1; i >= 0; --i) {
            let itemToRemove = src.find(p => config.getOptionValue(p) == idsToRemove[i]);
            let indexToRemove = src.indexOf(itemToRemove);
            src.splice(indexToRemove, 1);
        }
    };

    var filterArrayWithArray = function (src, dest, config) {
        let allIds = dest.map(p => config.getOptionValue(p));
        return src.filter(p => !allIds.includes(config.getOptionValue(p)));
    };

    // var moveArrayToArray = fucntion(src, dest, config){

    // }

    return {
        config: this.config = Object.assign({}, defaultConfig, config),
        // panelVisible: false,
        // search: '',
        options: [],
        values: [],

        available_scopes_selected: [],
        selected_scopes_selected: [],
        // focusedOptionIndex: -1,
        // initialValueControl: null,
        // initialOption: null,

        canAddSelected() { return !this.available_scopes_selected || this.available_scopes_selected.length == 0; },
        canAddAll() { return !this.options || this.options.length == 0; },
        canRemoveSelected() { return !this.selected_scopes_selected || this.selected_scopes_selected.length == 0; },
        canRemoveAll() { return !this.values || this.values.length == 0; },

        getIdOrNameFieldValue(prefix, index){
            return `${prefix}[${index}]`;
        },

        init() {
            this.values = this.config.values ?? [];
            this.options = filterArrayWithArray(this.config.options ?? [], this.values, this.config);

            // if (this.config.autoActiveFirstOption) { this.focusedOptionIndex = 0; }

            // this.initialValueControl = this.$refs.input.value;
            // if (this.initialValueControl && this.options.length != 0) {
            //     this.initialOption = this.config.findOptionByValue(this.options, this.initialValueControl);
            //     this.$refs.control.value = this.config.getOptionCaption(this.initialOption);
            //     this.search = this.$refs.control.value;
            //     if (this.search) { this.filterOptions(this.search); }
            // }

            // popperInstance = window.policy.popperJs.createPopper(this.$refs.control, this.$refs.popup, {
            //     placement: 'bottom-start',
            //     modifiers: [window.policy.popperJsModifiers.sameWidth]
            // });

            // this.$watch('search', (value) => {
            //     this.$refs.input.value = null;
            //     this.filterOptions(value);
            // });
            initialized = true;
        },
        addSelected() {
            if (!this.available_scopes_selected || this.available_scopes_selected.length == 0) { return; }
            let itemsToMove = getItemFrom(this.options, this.available_scopes_selected, this.config);
            this.values.push(...itemsToMove);
            removeItemFrom(this.options, this.available_scopes_selected, this.config);
            this.available_scopes_selected = [];
        },
        addAll() {
            if (!this.options || this.options.length == 0) { return; }
            let allIds = this.options.map(p => this.config.getOptionValue(p).toString());
            let itemsToMove = getItemFrom(this.options, allIds, this.config);
            this.values.push(...itemsToMove);
            removeItemFrom(this.options, allIds, this.config);
        },
        removeSelected() {
            if (!this.selected_scopes_selected || this.selected_scopes_selected.length == 0) { return; }
            let itemsToMove = getItemFrom(this.values, this.selected_scopes_selected, this.config);
            this.options.push(...itemsToMove);
            removeItemFrom(this.values, this.selected_scopes_selected, this.config);
            this.selected_scopes_selected = [];
        },
        removeAll() {
            if (!this.values || this.values.length == 0) { return; }
            let allIds = this.values.map(p => this.config.getOptionValue(p).toString());
            let itemsToMove = getItemFrom(this.values, allIds, this.config);
            this.options.push(...itemsToMove);
            removeItemFrom(this.values, allIds, this.config);
        }
    };

}

export { manySelector };
