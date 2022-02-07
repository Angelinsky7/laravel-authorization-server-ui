import * as popperJs from '@popperjs/core';
import * as alpineJs from './shared/alpineJs';
import * as popperJsModifiers from './shared/popperJs';

window.policy = {
    tableSelect: require('./shared/table-select'),
    modal: require('./shared/modal'),
    // navigable: require('./shared/navigable'),
    alpineJs: alpineJs,
    popperJs: popperJs,
    popperJsModifiers: popperJsModifiers
};
