<template>
    <div class="w-full relative" :class="class">
        <swiper 
            :slides-per-view="1"
            :navigation="navigation"
            class="h-full w-full z-1"
        >
            <template v-for="(item, index) in items" :key="index">
                <swiper-slide>
                    <div 
                        class="bg-cover w-full h-full lazy"
                        :data-bg="item.large"
                    >                        
                    </div>
                </swiper-slide>
            </template>
        </swiper>
        <template v-if="isFront">
            <div class="slider-prev bg-or-gray rounded-full absolute left-6 xl:-left-6 w-10 h-10 xl:w-12 xl:h-12 flex justify-center items-center z-10
                top-1/2 transform -translate-y-1/2 xl:translate-y-0 xl:top-12 transition-colors duration-500 cursor-pointer hover:text-white hover:bg-or-blue">
                <i class="icon-arrow-left text-lg xl:text-xl"></i>
            </div>
            <div class="slider-next bg-or-gray rounded-full absolute right-6 xl:-left-6 w-10 h-10 xl:w-12 xl:h-12 flex justify-center items-center z-10
                top-1/2 transform -translate-y-1/2 xl:translate-y-0 xl:top-28 transition-colors duration-500 cursor-pointer hover:text-white hover:bg-or-blue">
                <i class="icon-arrow-right text-lg xl:text-xl"></i>
            </div>  
        </template>
        <template v-else>
            <div class="slider-prev bg-white rounded-full absolute -left-3 lg:-left-10 w-12 h-12 lg:h-20 lg:w-20 flex justify-center items-center z-10
                top-1/2 transform -translate-y-1/2 transition-colors duration-500 cursor-pointer hover:text-white hover:bg-olympia-blue">
                <i class="icon-arrow-long-left text-2xl lg:text-3xl"></i>
            </div>
            <div class="slider-next bg-white rounded-full absolute w-12 h-12 lg:h-20 lg:w-20 flex justify-center items-center z-10
            -right-3 lg:-right-10 top-1/2 transform -translate-y-1/2 transition-colors duration-500 cursor-pointer hover:text-white hover:bg-olympia-blue">
                <i class="icon-arrow-long-right text-2xl lg:text-3xl"></i>
            </div>  
        </template>
    </div>
</template>

<script>
import SwiperCore, { Navigation } from 'swiper'
import { Swiper, SwiperSlide } from 'swiper/vue'

import Lazy from '../mixins/Lazy.vue'

SwiperCore.use([Navigation]);

export default {
    props: {
        items: {
            type: Object,
            required: true
        },
        class: {
            type: String,
            required: false
        }
    },

    computed: {
        isFront() {
            return this.class.includes('frontpage')
        }
    },

    data() {
        return {
            navigation: {
                nextEl: '.slider-next',
                prevEl: '.slider-prev',
            },            
        }
    },

    components: {
        Swiper,
        SwiperSlide
    },

    mixins: [Lazy],

    methods: {
        image(image) {
            let style = ''
            if (image.focus_css) {
                style += 'background-position: '+image.focus_css+';'
            }
            return style       
        },
    },
};

</script>