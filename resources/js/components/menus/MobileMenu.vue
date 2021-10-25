<template>
    <div 
        class="mobile-menu fixed right-0 top-0 bottom-0 overflow-x-hidden overflow-y-auto z-50 w-full md:w-[75vw] lg:w-[60vw] p-8 bg-or-blue"
        :class="(menuOpen ? 'open' : '')"
        ref="mobileMenu"
    >
        <div class="relative flex flex-col justify-between w-full h-full">
            <div class="flex justify-end px-4 z-100" @click="toggleMenu()"> 
                <div class="relative cursor-pointer h-8 w-8">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 origin-center h-[1px] transform rotate-45 w-8 bg-white"></div>
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 origin-center h-[1px] transform -rotate-45 w-8 bg-white"></div>
                </div>
            </div>
            <div class="flex flex-col text-white font-serif justify-center items-center z-10 w-full py-8">               
                <div class="space-y-4">
                    <div v-for="(item, index) in menu" :key="index" class="text-2xl 3x:text-3xl font-bold">
                        <a :href="item.url" :class="(item.is_current ? 'text-yellow font-bold' : '')" :title="item.title" v-if="item.url">{{ item.title }}</a>
                        <span :title="item.title" v-else>{{ item.title }}</span>
                        <template v-if="item.children.length > 0">
                        <div class="pt-4 pl-8 space-y-4">
                            <div v-for="(child, index) in item.children" :key="index" class="text-xl 3xl:text-2xl font-light">
                            <a :href="child.url" :class="(child.is_current ? 'text-yellow font-bold' : '')" :title="child.title" v-if="child.url">{{ child.title }}</a>
                            <span :title="child.title" v-else>{{ child.title }}</span>
                            </div>
                        </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="flex bg-or-pastel border border-or-blue shadow-pastel">
                    <template v-for="locale in locales" :key="locale.locale.key">
                        <div class="px-4 py-2" :class="{'bg-white' : locale.is_current }">
                            <a class="uppercase" :href="locale.permalink">{{ locale.locale.short }}</a>
                        </div>
                    </template>
                </div>
            </div>            
            <div>
                <div class="text-center py-8 flex flex-col md:flex-row flex-grow text-white items-center justify-center space-y-2 md:space-y-0 md:space-x-4">
                    <a class="inline-flex items-center" :href="'tel:'+config.telephone">
                        <span class="icon-phone mr-2"></span> <span v-html="config.telephone"></span>
                    </a>
                    <a class="inline-flex items-center" :href="'mailto:'+config.email">
                        <span class="icon-contact mr-2"></span> <span v-html="config.email"></span>
                    </a>
                </div>
            </div>           
        </div>
    </div>
</template>

<script>

import { mapState, mapMutations } from 'vuex'

export default {
    props: {
        menu: {
            type: Object,
            required: true
        },
        config: {
            type: Object,
            required: true
        },
        locales: {
            type: Object,
            required: false
        },
    },

    computed: {
        ...mapState({
            menuOpen: state => state.menu,
        }),
    },

    watch: {
        menuOpen() {
            document.getElementById('menu-button').classList.toggle('open')
            document.getElementById('app').classList.toggle('menu-open')
            document.body.style.overflow = this.menuOpen ? 'hidden' : ''
        },
    },

    methods: {
       ...mapMutations([
            'toggleMenu',
        ]),
        menuClass(item) {
            let cssClass = 'menu-item'
            if (item.is_current && item.url != null) {
                cssClass += ' current'
            }
            if (item.children.length > 0n) {
                cssClass += ' parent'
            }
            return cssClass
        },   
    }
}
</script>
