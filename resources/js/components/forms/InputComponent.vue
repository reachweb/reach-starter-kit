<template>
    <div class="input-field" :class="displayClass">
        <div class="w-full">
            <input 
                :type="inputType" 
                :id="name" 
                :value="modelValue"
                :placeholder="placeholder"
                class="w-full px-4 py-1 text-black shadow-pastel border border-or-blue focus:border-or-yellow text-lg"
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
        ],

        emits: [
            'update:modelValue'
        ],

        computed: {
            inputType: function() {
                if (this.type) {
                    return this.type
                }
                return 'text'
            }
        },

        methods: {
            updateValue: function(value) {
                this.$emit('update:modelValue', value)
            },
        }
    }
</script>