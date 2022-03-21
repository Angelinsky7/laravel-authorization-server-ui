import { parse } from "date-fns";

function timePicker(config) {

    let defaultConfig = {
        value: '',
    };

    let hour = '00';
    let minute = '00';
    let defaultValueIfEmpty = '00:00';
    let caretBeforeInput = -1;

    return {
        config: Object.assign({}, defaultConfig, config),

        touched: false,
        focused: false,
        error: null,

        _regexHour: /^[0-1][0-9]|2[0-3]$/,
        _regexMinute: /^[0-5][0-9]$/,

        onValueChanged: (p) => { },

        init() {
            this.value = this.config.value ? this.config.value : defaultValueIfEmpty;
            console.log(this.value, this.value);
        },

        _convertDateToIso(date) {
            return parse(date, 'dd/MM/yyyy HH:mm', new Date());
        },

        get value() {
            return `${this.hour}:${this.minute}`;
        },
        set value(value) {
            const valueInDateTime = new Date(Date.parse(this._convertDateToIso(`01/01/1900 ${value}`)));
            this.hour = valueInDateTime.getHours();
            this.minute = valueInDateTime.getMinutes();
        },

        get hour() { return hour; },
        set hour(value) {
            if (hour != value) {
                if (`${value}`.length == 1) { value = `0${value}`; }
                hour = value;
                this.onChange(this.value);
            }
        },
        get minute() { return minute; },
        set minute(value) {
            if (minute != value) {
                if (`${value}`.length == 1) { value = `0${value}`; }
                minute = value;
                this.onChange(this.value);
            }
        },

        onChange(value) {
            this.$dispatch('change', { value: value });
            this.onValueChanged(value);
        },

        _focusIn() {
            // console.log('focus In', this.focused);
            // if (!this.focused && !this.touched) {
            //     this.focused = true;
            //     this.$refs.hourCtrl.focus();
            //     this.hour = '';
            // }
        },

        _focusOut() {
            this.touched = true;
            this.focused = false;
            this.onChange(this.value);
        },

        _beforeHandleInput(evt, controlValue, nextElement, regexCheck) {
            if (evt.data) {

                let newValueResult = evt.target.value;
                const caretPositionStart = evt.target.selectionStart;
                const newValueAsArray = [...evt.data];

                if (evt.target.value && evt.target.value.length >= 2 && evt.target.selectionStart < 2) {
                    const currentValueAsArray = [...evt.target.value];

                    for (let i = 0; i < newValueAsArray.length; ++i) {
                        currentValueAsArray[evt.target.selectionStart + i] = newValueAsArray[i];
                    }

                    newValueResult = currentValueAsArray.join('');
                } else if (evt.target.value.length < 2) {
                    newValueResult = `${newValueResult}${evt.data}`;
                }

                if (regexCheck == null || regexCheck.test(newValueResult)) {
                    evt.target.value = newValueResult
                    this[controlValue] = newValueResult;
                    const caretPosition = caretPositionStart + newValueAsArray.length;
                    evt.target.setSelectionRange(caretPosition, caretPosition, "none");
                } else if (newValueResult.length < 2) {
                    evt.target.value = newValueResult;
                } else {
                    this[controlValue] = null;
                }

                evt.preventDefault();
            }

            if (evt.data && evt.target.selectionStart >= 2) { this._autoFocusNext(controlValue, nextElement); }
        },

        _handleInput(evt, controlValue, nextElement) {
            if (evt.target.selectionStart >= 2) { this._autoFocusNext(controlValue, nextElement); }
        },

        _autoFocusNext(controlValue, nextElement) {
            if (controlValue.length >= 2 && nextElement) {
                nextElement.focus();
                nextElement.setSelectionRange(0, 0, "none");
            }
        },

        _autoFocusPrev(evt, controlValue, prevElement) {
            if ((controlValue.length < 1 || evt.target.selectionStart <= 0) && prevElement) {
                prevElement.focus();
            }
        },
    }

}

export { timePicker };
