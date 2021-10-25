<template>
    <div class="w-full h-[50vh] xl:h-[62vh] relative">
        <swiper 
            :slides-per-view="1"
            :space-between="16"
            :navigation="navigation"
            :slidesPerView="'auto'"
            :centeredSlides="true"
            :loop="true"
            :loopAdditionalSlides="2"
            class="h-full w-full"
        >
            <template v-for="(item, index) in items" :key="index">
                <swiper-slide class="h-full !w-full lg:!w-3/6">
                    <div 
                        :href="item.url" 
                        class="flex flex-col lazy bg-cover w-full h-full z-1 justify-end" 
                        :style="image(item)"
                        :data-bg="item.large"
                    >                        
                    </div>
                </swiper-slide>
            </template>
        </swiper>
        <template v-if="this.$store.state.isLarge">
            <div class="rooms-nav flex items-center justify-center h-24 w-24 bg-or-blue rounded-full absolute top-8 right-[33.4%] z-10">
                <div class="rooms-prev flex items-center justify-center text-2xl transition-colors duration-500 cursor-pointer pr-2">
                    <i class="icon-caret-left text-white hover:text-or-yellow"></i>
                </div>
                <div class="rooms-next flex items-center justify-center text-2xl transition-colors duration-500 cursor-pointer pl-2">
                    <i class="icon-caret-right text-white hover:text-or-yellow"></i>
                </div>  
            </div>
        </template>        
    </div>
    <template v-if="! this.$store.state.isLarge">
        <div class="flex justify-around items-center py-6">
            <div class="rooms-prev bg-white rounded-full h-12 w-12 flex justify-center items-center z-10
            transition-colors duration-500 cursor-pointer hover:text-white hover:bg-or-blue">
                <i class="icon-arrow-left text-2xl"></i>
            </div>
            <div class="font-light text-center">{{ __("tap or") }}<br>{{ __("swipe") }}</div>
            <div class="rooms-next bg-white rounded-full h-12 w-12 flex justify-center items-center z-10
            transition-colors duration-500 cursor-pointer hover:text-white hover:bg-or-blue">
                <i class="icon-arrow-right text-2xl"></i>
            </div>
        </div>
    </template>
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
        limit: {
            type: Number,
            required: false,
            default: 3
        },
    },

    data() {
        return {
            navigation: {
                nextEl: '.rooms-next',
                prevEl: '.rooms-prev',
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