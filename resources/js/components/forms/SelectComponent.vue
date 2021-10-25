<template>
    <div class="select-field" :class="displayClass">
        <div class="field-container">
            <Dropdown 
                v-model="selected" 
                :options="options" 
                optionValue="value" 
                optionLabel="label" 
                :placeholder="placeholder"
                :filter="filter"
                class="w-full border px-2 py-1 shadow-pastel border-or-blue focus:border-or-yellow outline-none text-base"
                @change="updateValue"
            />
        </div>        
        <div class="text-sm text-red-600 mt-2" v-if="errors" v-text="errors"></div>
    </div>
</template>

<script>
    import Dropdown from 'primevue/dropdown/sfc';

    export default {
        props: [
            'modelValue',
            'placeholder',
            'displayClass',
            'errors',
            'icon',
            'options',
            'filter'
        ],

        emits: [
            'update:modelValue'
        ],

        components: {
            Dropdown
        },

        data() {
            return {
                selected: null
            }
        },

        watch: {
            modelValue(newValue) {
                this.selected = newValue
            }
        },

        methods: {
            updateValue() {
                this.$emit('update:modelValue', this.selected)
            },
        }
    }
</script>