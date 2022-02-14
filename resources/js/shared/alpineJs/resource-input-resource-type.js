function resourceInputResourceType(config) {

    var defaultConfig = {
        resources: [],
        value: [],
    };

    return {
        config: Object.assign({}, defaultConfig, config),

        resources: [],
        matches: [],
        search: config.value,

        init() {
            this.resources = this.config.resources;

            this._executeSearch(this.search);

            this.$watch('search', (value) => {
                this._executeSearch(value);
            });
        },

        get matchText() {
            let result = `Matches ${this.matches.length} of ${this.resources.length} resources`;
            if (this.matches.length > 0) { result += `: including "${this.matches[0].display_name}"`; }
            return result;
        },

        _executeSearch(value) {
            this.matches = this.resources.filter(p => p.type.includes(value));
        }
    };
}

export { resourceInputResourceType }
