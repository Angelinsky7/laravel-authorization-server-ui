function inputMask(config) {
    let defaultConfig = {
        value: '',
        mask: '',
        validation: '',
        placeholderChar: '_',
        validationCharReplacement: '◬'
    };

    let validationRegex = null;
    let valueWithoutMask = '';

    return {
        config: Object.assign({}, defaultConfig, config),

        value: '',
        inputValue: '',

        init() {
            this.value = this.config.value;
            validationRegex = new RegExp(this.config.validation);

            if (!this.value) {
                this.value = this.config.mask;
                this._setControlValue(this.value);
            }

            valueWithoutMask = this.value;
        },

        onChange(value) {
            this.$dispatch('change', { value: value });
        },

        // autoFocusNext(control, nextElement) {
        //     if (control.length >= 2 && nextElement) {
        //         nextElement.focus();
        //     }
        // },

        // autoFocusPrev(control, prevElement) {
        //     if (control.length < 1 && prevElement) {
        //         prevElement.focus();
        //     }
        // },

        _setCaretOnLastValidChar(position) {
            this.$refs.textCtrl.focus();
            this.$refs.textCtrl.setSelectionRange(position, position, "none");
        },

        _focusIn() {
            const valueAsArray = [...this.value];
            const firstCaretPosition = valueAsArray.indexOf(this.config.placeholderChar);
            this._setCaretOnLastValidChar(firstCaretPosition >= 0 ? firstCaretPosition : 0);
        },

        _setControlValue(value) {
            this.$refs.textCtrl.value = value;
        },

        _handleBeforeInput(event) {

            let newValue = [...this.value];
            const maskAsArray = [...this.config.mask];
            const charPosition = event.target.selectionStart;

            let nextCharPosition = charPosition;

            if (event.data) {
                const newChars = [...event.data];
                let indexOfNewChars = 0;

                while (indexOfNewChars < newChars.length) {
                    if (nextCharPosition >= newValue.length) { break; }

                    if (maskAsArray[nextCharPosition] == this.config.placeholderChar) {
                        newValue[nextCharPosition] = newChars[indexOfNewChars];
                        ++indexOfNewChars;
                    }
                    if (maskAsArray[nextCharPosition] == newChars[indexOfNewChars]) {
                        ++indexOfNewChars;
                    }
                    ++nextCharPosition;
                }
            } else {
                const modifier = event.inputType == "deleteContentForward" ? 0 : -1;
                const nextCharModifier = event.inputType == "deleteContentForward" ? 2 : 0;

                let indexOfCharsToRemove = event.target.selectionEnd;

                while (indexOfCharsToRemove >= nextCharPosition) {
                    const positionToRemove = indexOfCharsToRemove + modifier;
                    if (maskAsArray[positionToRemove] == this.config.placeholderChar) {
                        newValue[positionToRemove] = this.config.placeholderChar;
                    }
                    --indexOfCharsToRemove;
                }

                nextCharPosition = indexOfCharsToRemove + nextCharModifier;
            }

            const nextNewValue = newValue.join('');
            const partialNextNewValue = nextNewValue.replaceAll(this.config.placeholderChar, this.config.validationCharReplacement);

            if (validationRegex.test(partialNextNewValue)) {
                this.value = nextNewValue;
                event.target.value = this.value;

                if (nextCharPosition < 0) { nextCharPosition = 0 }
                if (nextCharPosition > maskAsArray.length) { nextCharPosition = maskAsArray.length; }

                this._setCaretOnLastValidChar(nextCharPosition);
                this.onChange(this.value);
            }

            event.preventDefault();
        },
    }
}

export { inputMask };
