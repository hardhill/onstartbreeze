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
                        <input class="fileLoader" ref="gpxInput" type="file" accept="text/xml+gpx" @change="sendFile">
                    </form>

                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="" v-if="activities.length==0">You have not activities!</div>
                        <div v-else>
                            <table>
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Started</td>
                                        <td>Title</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(activity,index) in activities" :key="activity.trackid">
                                        <td>{{index+1}}</td>
                                        <td>{{activity.start_at}}</td>
                                        <td>{{activity.title}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
import {Inertia} from "@inertiajs/inertia";

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
        const sendFile = (event)=>{
            if(gpxInput.value.files.length>0){
                console.log('file loading')
                let form = Inertia.form({
                    file:gpxInput.value.files[0]
                })
                form.post(route('gpx.save'),{})
            }
        }
        return {selectFile, gpxInput, sendFile}
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
