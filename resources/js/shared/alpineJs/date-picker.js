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

    let popperInstance = null;

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
        },

        _convertDateToIso(date, dateFormat) {
            return parse(date, dateFormat, new Date());
        },

        toggle() {
            this.showDatepicker = !this.showDatepicker;
            if (!popperInstance) {
                popperInstance = window.policy.popperJs.createPopper(this.$refs.control, this.$refs.panel, {
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

        formatDateForDisplay(date) {
            return format(date, this.config.dateFormat);

            // let formattedDay = DAYS[date.getDay()];
            // let formattedDate = ("0" + date.getDate()).slice(-2);
            // let formattedMonth = MONTH_NAMES[date.getMonth()];
            // let formattedMonthShortName = MONTH_SHORT_NAMES[date.getMonth()];
            // let formattedMonthInNumber = ("0" + (parseInt(date.getMonth()) + 1)).slice(-2);
            // let formattedYear = date.getFullYear();

            // if (this.config.dateFormat === "dd-MM-yyyy") {
            //     return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 02-04-2021
            // } else if (this.config.dateFormat === "yyyy-MM-dd") {
            //     return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2021-04-02
            // } else if (this.config.dateFormat === "D d M, Y") {
            //     return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 02 Mar 2021
            // } else if (this.config.dateFormat === "dd/MM/yyyy") {
            //     return `${formattedDate}/${formattedMonthInNumber}/${formattedYear}`; // 02/04/2021
            // }

            // return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
        },

        getMonthName(month) {
            return MONTH_NAMES[month];
        },

        getDays() {
            return DAYS;
        },

        isSelectedDate(date) {
            const d = new Date(this.year, this.month, date);

            return this.datepickerValue === this.formatDateForDisplay(d) ? true : false;
        },
        isToday(date) {
            const today = new Date();
            const d = new Date(this.year, this.month, date);

            return today.toDateString() === d.toDateString() ? true : false;
        },
        getDateValue(date) {
            let selectedDate = new Date(this.year, this.month, date);

            this.datepickerValue = this.formatDateForDisplay(selectedDate);
            this.isSelectedDate(date);
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
