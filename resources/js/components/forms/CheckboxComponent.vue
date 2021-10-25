<template>    
    <div class="checkbox-field">
        <div class="p-field-checkbox flex items-center" :class="(inline ? 'p-field-checkbox-inline' : 'p-field-checkbox-block')" v-for="option in options" :key="option.name">
            <Checkbox :name="name" :id="option.name" :value="option.value" v-model="selected"></Checkbox>
            <label :for="option.name" v-html="label(option)" class="ml-2 text-md"></label>
        </div>
        <div class="text-sm text-red-600 mt-2" v-if="errors" v-text="errors"></div>
    </div>
</template>

<script>
import Checkbox from 'primevue/checkbox/sfc'

export default {
    props: {
        modelValue: [String, Boolean, Array],
        options: Object,
        inline: {
            type: Boolean,
            default: true
        },
        errors: [Object, String],
        name: String
    },

    components: {
        Checkbox
    },

    emits: [
        'update:modelValue'
    ],

    data() {
        return {
            selected: null
        }
    },

    watch: {
        selected() {
            this.$emit('update:modelValue', this.selected)
        }
    },

    methods: {
        label(option) {
             return this.__(option.label)
        }
    }

};
</script>