import { format, parse } from 'date-fns';

const MONTH_NAMES = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
const MONTH_SHORT_NAMES = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
];
const DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

function datePicker(config) {

    let defaultConfig = {
        value: null,
        dateFormat: "dd/MM/yyyy",
        nullByDefault: true,
        onlySelect: false
    };

    let onlyDateFormat = "dd/MM/yyyy";
    let popperInstance = null;
    let inputControlRef = null;
    let maskControlRef = null;
    let isChanging = false;

    return {
        config: Object.assign({}, defaultConfig, config),
        showDatepicker: false,
        datepickerValue: "",
        month: "",
        year: "",
        no_of_days: [],
        blankdays: [],

        init() {
            let today;

            if (this.config.value && this.config.value != 'null') {
                today = new Date(Date.parse(this._convertDateToIso(this.config.value, this.config.dateFormat)));
            } else {
                today = new Date();
            }

            this.month = today.getMonth();
            this.year = today.getFullYear();

            if (!this.config.nullByDefault || this.config.value) {
                this.datepickerValue = this.formatDateForDisplay(today);
            }

            this.getNumberOfDays();

            this.$nextTick(() => {
                this.$watch('datepickerValue', p => this._datePickerValueChanged(p));
                this._maskControl.onValueChanged = p => this._maskValueChanged(p);
            });
        },

        _convertDateToIso(date, dateFormat) {
            return parse(date, dateFormat, new Date());
        },

        get _inputControl() {
            if (inputControlRef == null) {
                inputControlRef = this.$root.querySelector('[data-js-datePickerControl]');
            }
            return inputControlRef;
        },

        get _maskControl() {
            if (maskControlRef == null) {
                maskControlRef = Alpine.$data(this._inputControl);
            }
            return maskControlRef;
        },

        toggle() {
            this.showDatepicker = !this.showDatepicker;
            this._ensurePopperInstance();
        },

        open() {
            this.showDatepicker = true;
            this._ensurePopperInstance();
        },

        close() {
            setTimeout(() => {
                this.showDatepicker = false;
            }, 150);
        },

        _ensurePopperInstance() {
            if (!popperInstance) {
                popperInstance = window.policy.popperJs.createPopper(this._inputControl, this.$refs.panel, {
                    placement: 'bottom-start',
                    modifiers: [window.policy.popperJsModifiers.sameWidth]
                });
                // this.popper = window.policy.popperJs.createPopper(this.$refs.trigger, this.$refs.popover, {
                //     placement: 'bottom',
                //     modifiers: [{
                //         name: 'computeStyles',
                //         options: {
                //             adaptive: false
                //         },
                //     }]
                // });
            }
        },

        _datePickerValueChanged(newValue) {
            if (!isChanging) {
                isChanging = true;

                const checkDate = Date.parse(this._convertDateToIso(newValue, this.config.dateFormat));
                if (isNaN(checkDate) === false) {
                    this._maskControl.setInputValue(newValue);
                }

                isChanging = false;
            }
        },

        _maskValueChanged(newValue) {
            if (!isChanging) {
                isChanging = true;

                const checkDate = Date.parse(this._convertDateToIso(newValue, this.config.dateFormat));
                if (isNaN(checkDate) === false) {
                    const validDate = new Date(checkDate);
                    this.month = validDate.getMonth();
                    this.year = validDate.getFullYear();
                    this.datepickerValue = format(checkDate, this.config.dateFormat);
                    this.isSelectedDay(validDate.getDate());
                } else {
                    this.datepickerValue = null;
                }

                isChanging = false;
            }
        },

        formatDateForDisplay(date) {
            return format(date, this.config.dateFormat);
        },

        getMonthName(month) {
            return MONTH_NAMES[month];
        },

        getDays() {
            return DAYS;
        },

        isSelectedDay(day) {
            const d = new Date(this.year, this.month, day);
            const datepickerValueDate = new Date(Date.parse(this._convertDateToIso(this.datepickerValue, this.config.dateFormat)));
            datepickerValueDate.setHours(0,0,0,0);
            return datepickerValueDate.getTime() === d.getTime() ? true : false;
        },
        isToday(date) {
            const today = new Date();
            today.setHours(0,0,0,0);
            const d = new Date(this.year, this.month, date);

            return today.getTime() === d.getTime() ? true : false;
        },
        setDateValue(date) {
            let selectedDate = new Date(this.year, this.month, date, 0, 0);

            this.datepickerValue = this.formatDateForDisplay(selectedDate);
            this.isSelectedDay(date);
            this.showDatepicker = false;
        },
        getNumberOfDays() {
            let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
            let dayOfWeek = new Date(this.year, this.month).getDay();
            let blankdaysArray = [];

            for (var i = 1; i <= dayOfWeek; i++) {
                blankdaysArray.push(i);
            }

            let daysArray = [];
            for (var i = 1; i <= daysInMonth; i++) {
                daysArray.push(i);
            }

            this.blankdays = blankdaysArray;
            this.no_of_days = daysArray;
        },

        previousDate() {
            if (this.month == 0) {
                this.year--;
                this.month = 12;
            }
            this.month--;
            this.getNumberOfDays();
        },

        nextDate() {
            if (this.month == 11) {
                this.month = 0;
                this.year++;
            } else {
                this.month++;
            }
            this.getNumberOfDays();
        }
    };
}

(function init() {
    var modals = document.createElement("div");
    modals.id = "policy-ui-datepicker-container";
    document.body.append(modals);
})();

export { datePicker };
