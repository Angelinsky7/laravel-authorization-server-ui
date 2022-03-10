function inputMask(config) {
    let defaultConfig = {

    };

    return {
        config: Object.assign({}, defaultConfig, config),

        day: '',
        month: '',
        year: '',

        init() {

        },

        get value() {
            return `${this.day}/${this.month}/${this.year}`;
        },

        onChange(value) {

        },

        autoFocusNext(control, nextElement) {
            if (control.length >= 2 && nextElement) {
                nextElement.focus();
            }
        },

        autoFocusPrev(control, prevElement) {
            if (control.length < 1 && prevElement) {
                prevElement.focus();
            }
        },

        _handleInput(control, nextElement) {
            this.autoFocusNext(control, nextElement);
            this.onChange(this.value);
        }

    }
}

export { inputMask };
