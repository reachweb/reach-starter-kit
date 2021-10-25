<template>
    <div class="uppercase text-xl mb-8">
        {{ __('Subscribe to our newsletter') }}
    </div>
    <div class="relative flex space-x-4">
        <input-component 
            v-model="email" 
            displayClass="w-full newsletter w-[70%] shadow-pastel"
            :errors="errors"
            :placeholder="__('Email address')"
        />
        <div class="">
            <button class="button button-pastel !px-2 !pt-2 !pb-1">
                <span class="icon-arrow-right"></span>
            </button>
        </div>
    </div>
    <div class="mt-4 newsletter-checkbox checkbox-footer">
        <checkbox-component
            v-model="accepted"
            :options="checkboxOptions"
        >
        </checkbox-component>
    </div>
</template>

<script>
import InputComponent from '../forms/InputComponent'
import CheckboxComponent from '../forms/CheckboxComponent'

export default {

    data() {
        return {
            email: '',    
            errors: '',
            accepted: false,
            disableSubmit: false,
            successMsg: false,
            checkboxOptions: [
                {
                    label: this.__('I accept the privacy policy'),
                    name: 'privacy',
                    value: true
                }
            ]
        }
    },

    components: {
        InputComponent,
        CheckboxComponent
    },

    methods: {
        toggleSubmit() {
            this.disableSubmit = !this.disableSubmit
        },
        submitForm() {
            this.clearErrors()
            this.toggleSubmit()
            axios.post('', this.email)
                .then(response => {
                    this.handleSuccess(response.data)
                })
                .catch(error => {
                    this.handleErrors(error.response)
                }).finally(() => {
                     
                });
        },
        handleSuccess(data) {
            if (data.success == true) {
               // this.successMsg = this.t.successForm
            }
            this.toggleSubmit()
        },
        handleErrors(errors) {
            this.errors = errors.data.error     
            this.toggleSubmit()
        },        
        clearErrors() {
            this.errors = ''
        },
        
    }

};
</script>