<template>
    <div class="input-field" :class="displayClass">
        <div class="field-container">
            <textarea 
                :id="name" 
                :value="modelValue"
                :placeholder="placeholder"
                class="w-full px-4 py-1 border shadow-pastel border-or-blue focus:border-or-yellow outline-none min-h-[90px]"
                @input="updateValue($event.target.value)"
            />
        </div>     
        <div class="text-sm text-red-600 mt-2" v-if="errors" v-text="errors"></div>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'placeholder',
            'type',
            'displayClass',
            'modelValue',
            'errors',
            'icon'
        ],

        methods: {
            updateValue: function(value) {
                this.$emit('update:modelValue', value)
            },
        }
    }
</script>