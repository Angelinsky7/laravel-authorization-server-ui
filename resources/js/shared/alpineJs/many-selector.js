function manySelector(config) {

    var initialized = false;

    var defaultConfig = {
        options: [],
        values: [],
        // autoActiveFirstOption: false,
        // emptyOptionsMessage: null,
        // filterValue(value) { return value.toString().toLowerCase(); },
        // filterOptions(options, filterValue) { return options.filter(p => this.getOptionCaption(p).toLowerCase().includes(filterValue)); },
        // getOptionCaption(option) { return option.caption ?? option; },
        // getOptionValue(option) { return option.value ?? option; },
        // isOptionDisabled(option) { return option.disabled ?? false; },
        // isOptionActive(focusedOptionIndex, index) { return focusedOptionIndex === index; },
        // findOptionByValue(options, value) { return options.find(p => this.getOptionValue(p) == value); }
    };

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

        addSelectedIsDisabled() { return !this.available_scopes_selected || this.available_scopes_selected.length == 0; },

        init() {
            this.options = this.config.options ?? [];
            this.values = this.config.values ?? [];
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
            let itemsToMove = this.options.filter(p => this.available_scopes_selected.includes(p.value.toString()));
            this.values.push(...itemsToMove);
            for (let i = this.available_scopes_selected.length - 1; i >= 0; --i) {
                let itemToRemove = this.options.find(p => p.value == this.available_scopes_selected[i]);
                let indexToRemove = this.options.indexOf(itemToRemove);
                this.options.splice(indexToRemove, 1);
            }
            this.available_scopes_selected = [];
        }
    };

}

export { manySelector };
