<template>
    <Link :href="href">
    <div class="border rounded-md px-3 py-2 hover:bg-gray-300 hover:border-red-700"><slot/></div>
    </Link>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'
export default {
    components:{
        Link
    },
    props:['href']
}
</script>