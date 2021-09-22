<template>
    <div v-if="hasErrors">
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
import { computed, ref } from 'vue'
export default {
    props:{
        errors:{
            type:Array,
            required:true
           
        }
    },
   setup(props){
       
       const errors = ref(props.errors)
       const hasErrors = computed(()=>{
           
           return errors.value.length > 0
       })
       
       return {errors,hasErrors}
   }
    
}
</script>
