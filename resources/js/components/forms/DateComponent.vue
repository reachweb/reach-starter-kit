<template>
    <div class="date-field" :class="displayClass">
        <div class="field-container">
            <Calendar 
            :id="name"
            :name="name"
            ref="datefield"
            :placeholder="placeholder"
            v-model="value" 
            :selectionMode="mode"
            dateFormat="dd/mm/y"
            :manualInput="false"
            @date-select="updateValue" />
            <div class="field-icon" @click="focusCalendar" v-if="icon">
                <i :class="'icon-'+icon"></i>
            </div>
        </div>        
        <div class="invalid-feedback" v-if="errors" v-text="errors"></div>
    </div>
</template>

<script>
    import Calendar from 'primevue/calendar/sfc'
    import dayjs from 'dayjs'

    export default {

        props: [
            'modelValue',
            'name',
            'placeholder',
            'displayClass',
            'selectionMode',
            'errors',
            'icon',
        ],

        components: {
            Calendar
        },

        emits: ['update:modelValue'],

        data() {
            return {
                value: null,
                mode: this.selectionMode ? this.selectionMode : 'single'
            }
        },

        watch: {
            modelValue(newValue) {
                this.value = newValue
            }
        },  

        methods: {
            updateValue() {            
                let value = this.value
                let calendar =  this.$refs.datefield
                if (this.selectionMode == 'range') {
                    value = _.map(this.value, (date) => dayjs(date).format('DD/MM/YYYY')).join(' to ')
                    if (Array.isArray(calendar.modelValue) && _.some(calendar.modelValue, item => _.isNull(item))) {
                        calendar.overlayVisible = false
                    }
                }
                this.$emit('update:modelValue', value)
            },
            focusCalendar() {
                this.$refs.datefield.onFocus();
            }
        }

    }
</script>