function tooltip() {
    return {
        open: false,
        popper: null,
        toggle() {
            this.open = !this.open;
            if (!this.popper) {
                this.popper = window.policy.popperJs.createPopper(this.$refs.trigger, this.$refs.popover, {
                    placement: 'bottom',
                    modifiers: [{
                        name: 'computeStyles',
                        options: {
                            adaptive: false
                        },
                    }]
                });
            }
        }
    }
}

(function init() {
    var modals = document.createElement("div");
    modals.id = "policy-ui-tooltip-container";
    document.body.append(modals);
})();

export { tooltip };
