function listBox(config) {

    var initialized = false;

    var defaultConfig = {
        dataSource: [],
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
        config: Object.assign({}, defaultConfig, config),
        // panelVisible: false,
        // search: '',
        dataSource: [],
        // focusedOptionIndex: -1,
        // initialValueControl: null,
        // initialOption: null,
        init() {
            this.dataSource = this.config.dataSource;
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
        }
    };

}

export { listBox };
