import * as popperJs from '@popperjs/core';
import * as alpineJs from './shared/alpineJs';
import * as popperJsModifiers from './shared/popperJs';
import * as unobtrusive from './shared/unobtrusive';
// import * as components from './components';
import { id as componentId } from './shared/component-id';

// declare global {
//     interface Window { policy: any; }
// }

window.policy = {
    // tableSelect: require('./shared/table-select'),
    // modal: require('./shared/modal'),
    // navigable: require('./shared/navigable'),
    unobtrusive: unobtrusive,
    alpineJs: alpineJs,
    popperJs: popperJs,
    popperJsModifiers: popperJsModifiers,
    // components: components,
    store: {},
    id: componentId
};
