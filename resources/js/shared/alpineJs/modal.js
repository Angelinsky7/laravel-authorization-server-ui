function modal(config) {

    var defaultConfig = {
        id: -1,
        showByDefault: true,
        modalData: {}
    };

    return {
        config: Object.assign({}, defaultConfig, config),
        id: null,
        show: false,
        modalData: {},
        init() {
            this.id = this.config.id;
            this.show = this.config.showByDefault;
            this.modalData = this.config.modalData;
        },
        close(result) {
            this._close();
            this.$dispatch(`js-policy-ui-modal-${this.id}-close`, { result: result });
        },
        _close() {
            this.show = false;
        }
    };
}

export { modal };
