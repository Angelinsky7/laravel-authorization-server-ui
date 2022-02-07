function select(config) {

    var popperInstance = null;
    var initialized = false;

    var defaultConfig = {
        options: [],
        autoActiveFirstOption: false,
        emptyOptionsMessage: null,
        filterValue(value) { return value.toString().toLowerCase(); },
        filterOptions(options, filterValue) { return options.filter(p => this.getOptionCaption(p).toLowerCase().includes(filterValue)); },
        getOptionCaption(option) { return option.caption ?? option; },
        getOptionValue(option) { return option.value ?? option; },
        isOptionDisabled(option) { return option.disabled ?? false; },
        isOptionActive(focusedOptionIndex, index) { return focusedOptionIndex === index; },
        findOptionByValue(options, value) { return options.find(p => this.getOptionValue(p) == value); }
    };

    return {
        config: this.config = Object.assign({}, defaultConfig, config),
        panelVisible: false,
        search: '',
        options: [],
        focusedOptionIndex: -1,
        initialValueControl: null,
        initialOption: null,
        init() {
            this.options = this.config.options;
            if (this.config.autoActiveFirstOption) { this.focusedOptionIndex = 0; }

            this.initialValueControl = this.$refs.input.value;
            if (this.initialValueControl && this.options.length != 0) {
                this.initialOption = this.config.findOptionByValue(this.options, this.initialValueControl);
                this.$refs.control.value = this.config.getOptionCaption(this.initialOption);
                this.search = this.$refs.control.value;
                if (this.search) { this.filterOptions(this.search); }
            }

            popperInstance = window.policy.popperJs.createPopper(this.$refs.control, this.$refs.popup, {
                placement: 'bottom-start',
                modifiers: [window.policy.popperJsModifiers.sameWidth]
            });

            this.$watch('search', (value) => {
                this.$refs.input.value = null;
                this.filterOptions(value);
            });
            initialized = true;
        },
        filterOptions(value) {
            if (initialized && !this.panelVisible) { this.togglePanel(); }

            const filterValue = this.config.filterValue(value);
            this.options = this.config.filterOptions(this.config.options, filterValue);

            if (this.options.length == 0) {
                if (this.config.emptyOptionsMessage != null) {
                    this.options.push({
                        'value': '',
                        'caption': this.config.emptyOptionsMessage,
                        'disabled': true
                    });
                } else {
                    this.closePanel();
                }
            }
        },
        closePanel() {
            this.panelVisible = false;
        },
        togglePanel() {
            if (!this.panelVisible) {
                this.search = this.$refs.control.value;
                this.focusedOptionIndex = this.config.autoActiveFirstOption ? 0 : -1;
                if (this.options.length == 0) { return; }
            }
            this.panelVisible = !this.panelVisible;
        },
        focusNextOption() {
            if (!this.panelVisible && this.options.length != 0) { this.togglePanel(); return; }
            ++this.focusedOptionIndex; //Should be find next available options
            if (this.focusedOptionIndex >= this.options.length) { this.focusedOptionIndex = 0; }
            this.$refs.popup.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            });
        },
        focusPreviousOption() {
            if (!this.panelVisible) { return; }
            --this.focusedOptionIndex; //Should be find next available options
            if (this.focusedOptionIndex < 0) { this.focusedOptionIndex = this.options.length - 1; }
            this.$refs.popup.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            });
        },
        selectOption(option) {
            var selectedOption = option ?? this.options[this.focusedOptionIndex];
            if (selectedOption == null || this.config.isOptionDisabled(selectedOption)) { return; }

            this.$refs.input.value = this.config.getOptionValue(selectedOption);
            this.$refs.control.value = this.config.getOptionCaption(selectedOption);

            this.closePanel();
        }
    };

    // return {
    //     data: config.data,
    //     emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',
    //     focusedOptionIndex: null,
    //     name: config.name,
    //     open: false,
    //     options: {},
    //     placeholder: config.placeholder ?? 'Select an option',
    //     search: '',
    //     value: config.value,

    //     closeListbox: function () {
    //         this.open = false;
    //         this.focusedOptionIndex = null;
    //         this.search = '';
    //     },

    //     focusNextOption: function () {
    //         if (this.focusedOptionIndex === null) { return this.focusedOptionIndex = Object.keys(this.options).length - 1; }
    //         if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) { return; }
    //         ++this.focusedOptionIndex;
    //         this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
    //             block: "center",
    //         });
    //     },

    //     focusPreviousOption: function () {
    //         if (this.focusedOptionIndex === null) { return this.focusedOptionIndex = 0; }
    //         if (this.focusedOptionIndex <= 0) { return; }
    //         --this.focusedOptionIndex;
    //         this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
    //             block: "center",
    //         });
    //     },

    //     init: function () {
    //         this.options = this.data;
    //         if (!(this.value in this.options)) { this.value = null; }
    //         this.$watch('search', ((value) => {
    //             if (!this.open || !value) return this.options = this.data
    //             this.options = Object.keys(this.data)
    //                 .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
    //                 .reduce((options, key) => {
    //                     options[key] = this.data[key]
    //                     return options
    //                 }, {});
    //         }))
    //     },

    //     selectOption: function () {
    //         if (!this.open) { return this.toggleListboxVisibility(); }
    //         this.value = Object.keys(this.options)[this.focusedOptionIndex];
    //         this.closeListbox();
    //     },

    //     toggleListboxVisibility: function () {
    //         if (this.open) { return this.closeListbox(); }
    //         this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value);
    //         if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0;
    //         this.open = true;
    //         this.$nextTick(() => {
    //             this.$refs.search.focus();
    //             this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
    //                 block: "center"
    //             });
    //         })
    //     },
    // }
}

export { select };
