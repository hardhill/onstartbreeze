<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
                <div class="flex">
                    <form>
                        <OsButton @click="selectFile">Load GPX</OsButton>
                        <input class="fileLoader" ref="gpxInput" type="file">
                    </form>

                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import {ref} from 'vue'
import OsLinkButton from '@/Components/ui/OsLinkButton.vue'
import OsButton from "@/Components/ui/OsButton";

export default {
    props:['activities']
    ,
    components: {
        OsButton,
        BreezeAuthenticatedLayout,
        Head,
        OsLinkButton
    },
    setup(){
        const gpxInput = ref(null)
        const selectFile = ()=>{
            console.log('load file')
            gpxInput.value.click()

        }
        return {selectFile, gpxInput}
    }
}
</script>
<style scoped lang="postcss">
.fileLoader{
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    width: 0.1px;
    height: 0.1px;
}
</style>
