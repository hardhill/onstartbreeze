<template>
  <Head title="Register" />
  <div class="relative w-full min-h-screen bg-gray-400">
    <div class="back"></div>
    <div class="dark">
      <div class="w-auto grid gap-4 grid-cols-1 place-items-center px-4">
        <div class="w-96 md:w-80">
          <StartLogo />
        </div>
        <div class="bg-gray-800 flex flex-col w-80 border border-gray-900 rounded-lg px-8 py-8">
          <div class="text-white mt-1">
            <h1 class="font-bold text-4xl">Welcome</h1>
            <p class="font-semibold">Let's create your account!</p>
          </div>
          <form class="flex flex-col mt-10" @submit.prevent="onSubmit">
             <div class="mb-3">
                 <label for="username" class="text-sm text-gray-400">Username</label>
                <input
                id="username"
                type="text"
                class="border rounded-lg py-3 px-3 bg-gray-700 border-gray-700 placeholder-gray-500 w-full" autocomplete
                v-model="userValue" @blur="userBlur"
                >
                <div  class="text-xs text-red-400">&nbsp;{{userError}}</div>
            </div> 
            <div class="mb-3">
                <label for="email" class="text-sm text-gray-400">Email</label>
                <input
                id="email"
                type="email"
                class="border rounded-lg py-3 px-3 bg-gray-700 border-gray-700 placeholder-gray-500 w-full"
                v-model="emailValue" @blur="emailBlur"
                >
                <div class="text-xs text-red-400">&nbsp;{{emailError}}</div>
            </div>
            <div class="mb-3">
                <label for="password" class="text-sm text-gray-400">Password</label>
                <input
                id="password"
                type="password"
                class="border rounded-lg py-3 px-3 bg-gray-700 border-gray-700 placeholder-gray-500 w-full" autocomplete
                v-model="passValue" @blur="passBlur"
                >
                <div class="text-xs text-red-400">&nbsp;{{passError}}</div>
            </div>
            <div class="mb-3">
                <label for="password_confiramtion" class="text-sm text-gray-400">Confirm password</label>
                <input
                id="password_confiramtion"
                type="password"
                class="border rounded-lg py-3 px-3 bg-gray-700 border-gray-700 placeholder-gray-500 w-full" autocomplete
                v-model="passconfValue" @blur="passconfBlur"
                >
                <div class="text-xs text-red-400">&nbsp;{{passconfError}}</div>
            </div>
            <BreezeValidationErrors class="mb-3" />
            <button class="border border-blue-500 bg-blue-500 text-white rounded-lg py-3 font-semibold" :disabled="manyAttempts || isSubmitting">Registration</button>
            <div class="text-xs text-red-400" v-if="manyAttempts">too many attempts. try it later</div>
          </form>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
import {watch, computed, onUpdated, ref } from "vue"
import {useField, useForm} from 'vee-validate'
import * as yup from 'yup'
import StartLogo from "@/Components/Logo.vue"
import { Inertia } from "@inertiajs/inertia"
import { Head } from '@inertiajs/inertia-vue3'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

export default {
  components: {
    StartLogo,
    Head,
    BreezeValidationErrors
  },
  setup() {
    
    const {handleSubmit, isSubmitting, submitCount} = useForm()
    const {value:userValue,errorMessage:userError,handleBlur:userBlur} = useField('name',yup.string().required().min(3))
    const {value:emailValue,errorMessage:emailError,handleBlur:emailBlur} = useField('email',yup.string().trim().required().email())
    const {value:passValue,errorMessage:passError,handleBlur:passBlur} = useField('password',yup.string().trim().required().min(8))
    const {value:passconfValue,errorMessage:passconfError,handleBlur:passconfBlur} = useField('password_confirmation',yup.string().trim().required().min(8))
    
    const onSubmit = handleSubmit(async(values)=>{
      let form = Inertia.form({
            name:values.name,
            email:values.email,
            password:values.password,
            password:values.password_confirmation
          })
          form.post(route('register'),{
                
            })

    })
    const manyAttempts = computed(()=>{return submitCount.value>=3})
    watch(manyAttempts,val=>{
          if(val){
            setTimeout(()=>(submitCount.value=0),3000)
          }
        })
    return {
      userValue, userError, userBlur,
      emailValue, emailError, emailBlur,
      passValue, passError, passBlur,
      passconfValue, passconfError, passconfBlur,
      onSubmit, manyAttempts, isSubmitting,
    
    }
  },
}
</script>

<style scoped>
.back {
  position: absolute;
  background-size: cover;
  background-position: center;
  background-image: url("https://images.theconversation.com/files/303322/original/file-20191124-74557-16zkcnl.jpg?ixlib=rb-1.1.0&rect=60%2C874%2C5643%2C2821&q=45&auto=format&w=2560&h=1440&fit=crop");
  height: 100vh;
  width: 100%;
  background-repeat: no-repeat;
}
.dark {
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  background-size: cover;
  background-color: rgba(73, 66, 52, 0.657);
  /* z-index: 1; */
  width: 100%;
  height: 100vh;
}

</style>