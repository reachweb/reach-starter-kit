<script>
import LazyLoad from "vanilla-lazyload"

export default {

    data() {
        return {
            lazyCompleted: false
        }
    },
    mounted() {
        if (!document.lazyLoadInstance) {
            document.lazyLoadInstance = new LazyLoad({
            	callback_loaded: () => {
	            	this.lazyCompleted = true
        		}
            })
        }
    }
}
</script>