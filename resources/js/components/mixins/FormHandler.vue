<script>
export default {

    data() {
        return {           
            submit: '', 
            errors: '',
            fatalError: false,
            disableSubmit: false,
            successMsg: false
        }
    },

    methods: {
        createSubmit() {
            let formFields = {}            
            for (const field of this.form.fields) {
                Object.assign(formFields, {[field.handle]: ''})
            }
            this.submit = formFields
            this.url = this.form.url
        },
        submitForm() {
            this.clearErrors()
            this.toggleSubmit()
            axios.post(this.url, this.submit)
                .then(response => {
                    this.handleSuccess(response.data)
                })
                .catch(error => {
                    this.handleErrors(error.response)
                })
        },
        clearErrors() {
            this.errors = ''
            this.fatalError = ''
        },
        toggleSubmit() {
            this.disableSubmit = !this.disableSubmit
        },
        handleSuccess(data) {            
            if (data.success == true) {
                this.successMsg = this.__('Thank you for your message! We will get back to you shortly!')
            }
            this.toggleSubmit()
            // Google analytics
            // window.dataLayer = window.dataLayer || []
            // window.dataLayer.push({
            //     'event': 'formSubmitted'
            // })
        },
        handleErrors(errors) {
            if (errors.status == 500) {
                this.fatalError = true
            } else {
                this.errors = errors.data.error
            }           
            this.toggleSubmit()
        },
        createOptions(field) {
            let options = [];
            Object.keys(field.options).forEach(key => options.push({label: field.options[key], value:key }))
            return options
        },
        fieldLabel(field) {
            if (field.type == 'checkboxes' && _.size(field.options) == 1) {
                return false
            }
            return this.__(field.display)
        },
        isHoneypot(field) {
            if (field.handle == this.form.honeypot) {
                return ' field-special'
            }
            return ''
        }
        
    }

};
</script>