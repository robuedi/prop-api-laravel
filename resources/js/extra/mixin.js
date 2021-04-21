import Vue from 'vue'

Vue.mixin({
    methods: {
        buildFormData(formData, data, parentKey) {
            //check if object and not special types
            if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {

                Object.keys(data).forEach(key => {
                    this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
                });

            } else {
                const value = data === null ? '' : data;

                formData.append(parentKey, value);
            }
        }
    }
})
