let globalPolicyUiIdMemo = {};

function id(componentName, componentKey = null) {
    if (!globalPolicyUiIdMemo[componentName]) { globalPolicyUiIdMemo[componentName] = 0; }
    const id = ++globalPolicyUiIdMemo[componentName];
    return componentKey ?
        `${componentName}-${id}-${componentKey}` :
        `${componentName}-${id}`;
}

export { id };
