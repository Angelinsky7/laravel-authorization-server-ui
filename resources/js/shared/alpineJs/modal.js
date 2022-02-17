function modal(config) {

    var defaultConfig = {
        id: -1,
        showByDefault: true,
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        id: null,
        show: false,
        init() {
            this.id = this.config.id;
            this.show = this.config.showByDefault;
        },
        close(result) {
            this.$dispatch(`js-policy-ui-modal-${this.id}-close`, { result: result });
        }
    };
}

export { modal };
