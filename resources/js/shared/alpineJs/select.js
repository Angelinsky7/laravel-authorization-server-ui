function select(config) {

    var popperInstance = null;
    var initialized = false;

    var defaultConfig = {
        options: [],
        autoActiveFirstOption: false,
        emptyOptionsMessage: null,
        filterValue(value) { return value.toString().toLowerCase(); },
        filterOptions(options, filterValue) { return options.filter(p => p.caption.toLowerCase().includes(filterValue)); },
        // getOptionCaption(option) { return option.caption ?? option; },
        // getOptionValue(option) { return option.value ?? option; },
        isOptionDisabled(option) { return option.disabled ?? false; },
        isOptionActive(focusedOptionIndex, index) { return focusedOptionIndex === index; },
        findOptionByValue(options, value) { return options.find(p => p.value == value); },
        onItemChange: null
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
                this.$refs.control.value = this.initialOption != null ? this.initialOption.caption : null;
                if (this.initialOption != null) { this.$nextTick(() => this.$dispatch('item-change', { option: this.initialOption })); }
                this.search = this.$refs.control.value;
                if (this.search) { this.filterOptions(this.search); }
            }

            popperInstance = window.policy.popperJs.createPopper(this.$refs.control, this.$refs.popup, {
                placement: 'bottom-start',
                modifiers: [window.policy.popperJsModifiers.sameWidth]
            });

            this.$watch('search', (value) => {
                if (!value || this.options.filter(p => p.caption == value) == 0) {
                    this.$refs.input.value = null;
                    this.$dispatch('item-change', { option: null });
                }
                this.filterOptions(value);
            });

            initialized = true;
        },
        get currentSelectedOption() {
            if (this.focusedOptionIndex == -1) { return null; }
            return this.options[this.focusedOptionIndex];
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
            let selectedOption = option ?? this.options[this.focusedOptionIndex];
            if (selectedOption == null || this.config.isOptionDisabled(selectedOption)) { return; }

            this.$refs.input.value = selectedOption.value;
            this.$refs.control.value = selectedOption.caption;

            this.closePanel();

            this.$dispatch('item-change', { option: option });
        }
    };

}

export { select };
