<script>
import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState({
            trans: state => state.trans
        }),
    },
    methods: {
        __(key) {
            return _.get(this.trans, key, key);
        },
    }
}
</script>