<template>
	<div class="form-component-container w-full" ref="formComponent">
		<div class="form-success w-full text-xl text-center my-8 font-bold" v-if="successMsg" v-html="successMsg"></div>
		<div class="flex flex-wrap " v-if="! successMsg">
			<div class="fatal-error" v-if="fatalError">{{ __('Oh no! Something is wrong with our form! Please contact us by phone or email.') }}</div>
			<template v-for="(field, index) in form.fields" :key="index">
                <div class="mb-4 px-4" :class="calculateWidth(field)">		
    				<div class="font-bold uppercase mb-2 text-md" v-if="fieldLabel(field)">
                        {{ fieldLabel(field) }}
                        <span v-if="field.prepend" v-html="field.prepend"></span>
                    </div>
    				<input-component
    					v-if="field.type == 'text' && field.input_type == 'text'"
    					v-model="submit[field.handle]"
    					:name="field.handle"
    					:errors="errors[field.handle]"
    				/>
                    <date-component
    					v-if="field.type == 'text' && field.input_type == 'date'"
    					v-model="submit[field.handle]"
    					:name="field.handle"
    					:selection-mode="checkPlacehoderForRange(field)"
    					:errors="errors[field.handle]"
    				/>
    				<textarea-component
    					v-if="field.type == 'textarea'"
    					v-model="submit[field.handle]"
    					:name="field.handle"
    					:errors="errors[field.handle]"
    				/>
                    <select-component
                        v-if="field.type == 'select'"
                        v-model="submit[field.handle]"
                        :name="field.handle"
                        :options="createOptions(field)"
                        :placeholder="__('Please select')"
                        :filter="(field.handle == 'country' ? true : false)"
                        :errors="errors[field.handle]"
                    />
                    <checkbox-component
                        v-if="field.type == 'checkboxes'"
                        v-model="submit[field.handle]"
                        :name="field.handle"
                        :options="createOptions(field)"
                        :errors="errors[field.handle]"
                    />
                </div>
			</template>
            <div class="submit-button w-full mt-6 flex justify-center">
                <button class="p-ripple p-4 flex button button-blue" 
                    :disabled="disableSubmit" 
                    @click="submitForm"
                >
                    <span v-html="label"></span>
                </button>
            </div>			
		</div>
	</div>
</template>

<script>

import FormHandler from '../mixins/FormHandler.vue'
import InputComponent from './InputComponent.vue'
import TextareaComponent from './TextareaComponent.vue'
import SelectComponent from './SelectComponent.vue'
import CheckboxComponent from './CheckboxComponent.vue'
import DateComponent from './DateComponent.vue'

export default {
    props: {
        'form': Object,
    },

    components: {
    	InputComponent,
    	TextareaComponent,
        SelectComponent,
        CheckboxComponent,
        DateComponent,
    },

    mixins: [FormHandler],

    computed: {
        label() {
            return (this.disableSubmit ? this.__('Sending...') : this.__('Send your message'))
        }
    },

    mounted() {
        this.createSubmit()
    },

    methods: {
        calculateWidth(field) {
            if (field.handle == this.form.honeypot) {
                return 'hidden'
            }
            if (field.width == 100) {
                return 'w-full'
            }
            if (field.width == 75) {
                return 'w-full xl:w-3/4'
            }
            if (field.width == 50) {
                return 'w-full xl:w-1/2'
            }
            if (field.width == 33) {
                return 'w-full xl:w-1/3'
            }
            if (field.width == 25) {
                return 'w-full xl:w-1/4'
            }
        },
    }
   
};
</script>