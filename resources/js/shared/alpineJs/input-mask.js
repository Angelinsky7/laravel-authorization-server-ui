function inputMask(config) {
    let defaultConfig = {
        value: '',
        mask: '',
        validation: '',
        placeholderChar: '_',
        validationCharReplacement: '◬'
    };

    let validationRegex = null;
    let maskAsArray = null;
    let textCtrlRef = null;

    return {
        config: Object.assign({}, defaultConfig, config),

        value: '',
        error: null,

        onValueChanged: (p) => { },

        init() {
            this.value = this.config.value;

            if (this.config.validation) {
                validationRegex = new RegExp(this.config.validation);
            }

            maskAsArray = [...this.config.mask];

            if (!this.value) {
                this.value = this.config.mask;
                this._setControlValue(this.value);
            }
        },

        onChange(value) {
            this.$dispatch('change', { value: value });
            this.onValueChanged(value);
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

        get _textCtrl() {
            if (textCtrlRef) { return textCtrlRef; }
            if (this.$refs.textCtrl != null) { textCtrlRef = this.$refs.textCtrl; return textCtrlRef; }

            textCtrlRef = this.$el.querySelector('input[data-js-txtCtrl]')
            return textCtrlRef;
        },

        _setCaretOnLastValidChar(position) {
            this._textCtrl.focus();
            this._textCtrl.setSelectionRange(position, position, "none");
            // this.$refs.textCtrl.focus();
            // this.$refs.textCtrl.setSelectionRange(position, position, "none");
        },

        _focusIn() {
            const valueAsArray = [...this.value];
            const firstCaretPosition = valueAsArray.indexOf(this.config.placeholderChar);
            this._setCaretOnLastValidChar(firstCaretPosition >= 0 ? firstCaretPosition : 0);
        },

        _setControlValue(value) {
            this._textCtrl.value = value;
            // this.$refs.textCtrl.value = value;
        },

        _getAvailablePositionMaskArray(mask) {
            const result = new Array(mask.length);

            for (let i = 0; i < mask.length; ++i) {
                result[i] = mask[i] == this.config.placeholderChar;
            }

            return result;
        },

        _getNextAvailablePositionInMaskArray(availableMask, position) {
            let i = position;
            while (i < availableMask.length) {
                if (availableMask[i]) { return i; }
                ++i;
            }
            return null;
        },

        _isNewValueIsSameAsMaskNonPlaceholder(newValue, mask, position) {
            return newValue != this.config.placeholderChar && newValue == mask[position];
        },

        _handleBeforeInput(event) {
            const charPosition = event.target.selectionStart;
            let newValue = [...this.value];
            let nextCharPosition = charPosition;

            if (event.data) {
                const newChars = [...event.data];
                const availablePositionMaskArray = this._getAvailablePositionMaskArray(maskAsArray);

                for (let i = 0; i < newChars.length; ++i) {
                    const maskPosition = charPosition + i;
                    const newValueChar = newChars[i];
                    if (this._isNewValueIsSameAsMaskNonPlaceholder(newValueChar, maskAsArray, maskPosition)) {
                        continue;
                    }

                    let correctMaskPosition = availablePositionMaskArray[maskPosition] ? maskPosition : this._getNextAvailablePositionInMaskArray(availablePositionMaskArray, maskPosition);
                    if (correctMaskPosition != null) {
                        newValue[correctMaskPosition] = newValueChar;
                        nextCharPosition = correctMaskPosition + 1;
                    }
                }
            } else {
                const modifier = event.inputType == "deleteContentForward" ? 0 : -1;
                //TODO(demarco): i would like to have a delete that go the the next space but don't move the caret
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

            if (validationRegex == null || validationRegex.test(partialNextNewValue)) {
                this.error = null;

                this.value = nextNewValue;
                event.target.value = this.value;

                if (nextCharPosition < 0) { nextCharPosition = 0 }
                if (nextCharPosition > maskAsArray.length) { nextCharPosition = maskAsArray.length; }

                this._setCaretOnLastValidChar(nextCharPosition);
                this.onChange(this.value);
            } else {
                this.error = 'Invalid input';
            }

            event.preventDefault();
        },
    }
}

export { inputMask };
