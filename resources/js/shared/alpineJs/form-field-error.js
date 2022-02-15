function formFieldError(id, field) {
    return {
        errors: null,
        init() {
            const error_id = (this.$id(id).toString().replaceAll('-', '_'));
            this.errors = window[error_id];
        },
        has() {
            return this.errors.default[field] !== undefined;
        },
        get() {
            return this.errors.default[field];
        }
    };
}

export { formFieldError };
